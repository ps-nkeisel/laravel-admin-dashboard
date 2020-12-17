<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\EntryFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Entry;
use App\Models\Nationality;
use App\Models\Entrypassport;
use App\Models\Language;
use App\Models\Useraction;
use App\Jobs\ProcessRedisStoreEntry;
use Carbon\Carbon;

class EntryController extends Controller
{
    public function search(Request $request) {
        $query = Entry::with(['createdUser', 'updatedUser', 'controlledUser']);

        $filters = $request->filters;
        if (isset($filters['countrytocode'])) {
            $query->where('countrytocode', $filters['countrytocode']);
        }
        if (isset($filters['version'])) {
            $query->where('version', $filters['version']);
        }
        if (isset($filters['time_containment']) && $filters['time_containment'] != 'all') {
            $time_containment = $filters['time_containment'];
            $from = '';
            $to = '';
            if ($time_containment == 'today') {
                $from = Carbon::now()->yesterday();
                $to = Carbon::now()->tomorrow();
            } else if ($time_containment == 'this_week') {
                $from = Carbon::now()->startOfWeek();
                $to = Carbon::now()->endOfWeek();
            } else if ($time_containment == 'last_week') {
                $from = Carbon::now()->subWeek()->startOfWeek();
                $to = Carbon::now()->subWeek()->endOfWeek();
            } else if ($time_containment == 'this_month') {
                $from = Carbon::now()->startOfMonth();
                $to = Carbon::now()->endOfMonth();
            } else if ($time_containment == 'last_month') {
                $from = Carbon::now()->subMonth()->startOfMonth();
                $to = Carbon::now()->subMonth()->endOfMonth();
            } else if ($time_containment == 'this_year') {
                $from = Carbon::now()->startOfYear();
                $to = Carbon::now()->endOfYear();
            } else if ($time_containment == 'last_year') {
                $from = Carbon::now()->subYear()->startOfYear();
                $to = Carbon::now()->subYear()->endOfYear();
            }
            $query->whereBetween('created_at', [$from, $to]);
        }
        $query->where(function ($que) use ($filters) {
            $active = (isset($filters['active']) && $filters['active'] == '1') ? 1 : 0;
            $archive = (isset($filters['archive']) && $filters['archive'] == '1') ? 1 : 0;
            if ($active && $archive) {
                $que->where('active', $active)
                    ->orWhere('archive', $archive);
            } else {
                $que->where('active', $active)->where('archive', $archive);
            }
        });

        $entries = $query->get();

        if (isset($filters['nationality_ids']) && sizeof($filters['nationality_ids'])) {
            $nationality_ids = $filters['nationality_ids'];

            $entries = $entries->reject(function ($entry, $key) use($nationality_ids) {
                $has_nat = true;
                foreach ($nationality_ids as $nat_id) {
                    if (!$entry->nationalities()->find($nat_id)) {
                        $has_nat = false;
                        break;
                    }
                }
                return !$has_nat;
            });

            $entries = $entries->values();
        }

        $columns = [];
        foreach ($request->columns as $col) {
            array_push($columns, $col['data']);
        }

        $order_col_index = $request->order[0]['column'];
        $order_col = $columns[$order_col_index];
        $order_dir = $request->order[0]['dir'];

        $start = $request->start;
        $length = $request->length;

        if ($order_dir == 'asc') {
            $entries = $entries->sortBy($order_col);
        } else {
            $entries = $entries->sortByDesc($order_col);
        }

        $data = $entries->slice($start, $length);
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $entries->count(),
        	'recordsFiltered' => $entries->count(),
            'data' => $data
        ]);
    }

    public function search_nats(Request $request) {
        try {
            $entry = Entry::findOrFail($request->id);

            $columns = [];
            foreach ($request->columns as $col) {
                array_push($columns, $col['data']);
            }

            $order_col_index = $request->order[0]['column'];
            $order_col = $columns[$order_col_index];
            $order_dir = $request->order[0]['dir'];

            $start = $request->start;
            $length = $request->length;

            $query = $entry->nationalities();
            $query->where(function ($que) use ($request) {
                $que->where('name_en', 'LIKE', "%{$request->search['value']}%");
                $que->orWhere('name_de', 'LIKE', "%{$request->search['value']}%");
            });
            $result = $query->get();
            $data = $query->orderBy($order_col, $order_dir)->offset($start)->take($length)->get();
            $data = array_values($data->toArray());

            return response()->json([
                'recordsTotal' => $result->count(),
                'recordsFiltered' => $result->count(),
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

    public function search_versions(Request $request) {
        $query = Entry::with(['createdUser', 'updatedUser', 'controlledUser']);

        $query->where('assignto', $request->assignto)
            ->where('version', 'LIKE', "%{$request->search['value']}%");

        $columns = [];
        foreach ($request->columns as $col) {
            array_push($columns, $col['data']);
        }

        $order_col_index = $request->order[0]['column'];
        $order_col = $columns[$order_col_index];
        $order_dir = $request->order[0]['dir'];

        $start = $request->start;
        $length = $request->length;

        $result = $query->get();
        $data = $query->orderBy($order_col, $order_dir)->offset($start)->take($length)->get();
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $result->count(),
        	'recordsFiltered' => $result->count(),
            'data' => $data
        ]);
    }

    public function get_id(Request $request) {
        try {
            $entry = Entry::where('assignto', $request->assignto)->where('version', $request->version)->firstOrFail();
            return response()->json($entry->id);
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

    public function compare(Request $request) {
        try {
            $entry1 = Entry::findOrFail($request->id1);
            $entry2 = Entry::findOrFail($request->id2);

            $nationalities = $entry1->nationalities->merge($entry2->nationalities);
            foreach ($entry1->nationalities as $nat1) {
                $nationalities->find($nat1->id)->active1 = true;
            }
            foreach ($entry2->nationalities as $nat2) {
                $nationalities->find($nat2->id)->active2 = true;
            }

            $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
            $contentadditionals_count = $entry1->contentadditionals->count();
            if ($entry2->contentadditionals->count() > $contentadditionals_count) {
                $contentadditionals_count = $entry2->contentadditionals->count();
            }
            $contentadditionals = [];
            for ($position = 1; $position <= $contentadditionals_count; $position ++) {
                $contentadditional1 = $entry1->contentadditionals()->with('languages')->where('position', $position)->first();
                $contentadditional2 = $entry2->contentadditionals()->with('languages')->where('position', $position)->first();
                array_push($contentadditionals, [
                    '1' => $contentadditional1,
                    '2' => $contentadditional2,
                ]);
            }

            return response()->json([
                'entry1' => $entry1,
                'entry2' => $entry2,
                'nationalities' => $nationalities,
                'contentadditionals' => $contentadditionals,
                'languages' => $languages,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

    public function check(Request $request) {
        $entry = Entry::findOrFail($request->entry_id);
        $entry->update([
            $request->key => $request->value
        ]);

        $useraction = new Useraction;
        $useraction->assigntype = 2;   // Entry
        $useraction->assigntonew = $entry->id;
        if ($request->key == 'checkedandok') {
            $useraction->type = 5;         // Record checked and ok
        } else {
            $useraction->type = 6;         // Record checked and not ok
        }
        if ($request->value) {
            $useraction->comment = 'check';
        } else {
            $useraction->comment = 'uncheck';
        }
        $useraction->code = $entry->countrytocode;
        $useraction->version = $entry->version;
        $useraction->created_user = $request->user_id;
        $useraction->created_ip = $request->ip();
        $useraction->save();
    }

    public function report(Request $request) {
        $entry = Entry::findOrFail($request->id);
        $language = Language::where('code', $request->lang)->firstOrFail();

        $report = $entry->getReport($language);

        return response()->json($report);
    }

    public function preview(EntryFormRequest $request) {
        $language = Language::where('code', 'en')->firstOrFail();
        return response()->json(Entry::getPreview($request, $language));
    }

    public function check_noinfos(Request $request) {
        $query = Entry::with(['createdUser', 'updatedUser', 'controlledUser']);

        $query->where('active', 1);
        $query->where('no_info_available', 1);

        $columns = [];
        foreach ($request->columns as $col) {
            array_push($columns, $col['data']);
        }

        $query->where(\DB::raw('CONCAT_WS(" ", '.implode(",", $columns).')'), 'LIKE', "%{$request->search['value']}%");

        $order_col_index = $request->order[0]['column'];
        $order_col = $columns[$order_col_index];
        $order_dir = $request->order[0]['dir'];

        $start = $request->start;
        $length = $request->length;

        $result = $query->get();
        $data = $query->orderBy($order_col, $order_dir)->offset($start)->take($length)->get();
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $result->count(),
        	'recordsFiltered' => $result->count(),
            'data' => $data
        ]);
    }

    public function check_tempstops(Request $request) {
        $query = Entry::with(['createdUser', 'updatedUser', 'controlledUser']);

        $query->where('active', 1);
        $query->where('temp_entry_stop', 1);

        $columns = [];
        foreach ($request->columns as $col) {
            array_push($columns, $col['data']);
        }

        $query->where(\DB::raw('CONCAT_WS(" ", '.implode(",", $columns).')'), 'LIKE', "%{$request->search['value']}%");

        $order_col_index = $request->order[0]['column'];
        $order_col = $columns[$order_col_index];
        $order_dir = $request->order[0]['dir'];

        $start = $request->start;
        $length = $request->length;

        $result = $query->get();
        $data = $query->orderBy($order_col, $order_dir)->offset($start)->take($length)->get();
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $result->count(),
        	'recordsFiltered' => $result->count(),
            'data' => $data
        ]);
    }

    public function check_passassign(Request $request) {
        $filters = $request->filters;

        $status = 'success';

        $nationalities = collect();
        $entries = collect();

        if (isset($filters['countrytocode'])) {
            $entries = Entry::with('nationalities')->where('active', 1)->where('countrytocode', $filters['countrytocode'])->get();
            if ($entries->count() == 0) {
                $status = 'error';
            } else {
                if (isset($filters['nationality_ids']) && sizeof($filters['nationality_ids']) &&
                    isset($filters['entrypassport_ids']) && sizeof($filters['entrypassport_ids']))
                {
                    $nationalities = Nationality::where('active', 1)->find($filters['nationality_ids']);
                    $entrypassports = Entrypassport::orderBy('position', 'asc')->find($filters['entrypassport_ids']);

                    foreach ($nationalities as $nationality) {
                        $nationality->passassign = 'yes';
                        foreach ($entries as $entry) {
                            if ($entry->nationalities->find($nationality->id)) {
                                foreach ($entrypassports as $entrypas) {
                                    if (!$entry->entrypassports()->find($entrypas)) {
                                        $nationality->passassign = 'no';
                                        break;
                                    }
                                }
                                if ($nationality->passassign == 'no') {
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }

        $columns = [];
        foreach ($request->columns as $col) {
            array_push($columns, $col['data']);
        }

        $order_col_index = $request->order[0]['column'];
        $order_col = $columns[$order_col_index];
        $order_dir = $request->order[0]['dir'];

        $start = $request->start;
        $length = $request->length;

        if ($order_dir == 'asc') {
            $nationalities = $nationalities->sortBy($order_col);
        } else {
            $nationalities = $nationalities->sortByDesc($order_col);
        }
        $data = $nationalities->slice($start, $length);
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $nationalities->count(),
        	'recordsFiltered' => $nationalities->count(),
            'data' => $data,
            'status' => $status
        ]);
    }

    public function check_reminder(Request $request) {
        $entries = Entry::with(['contentadditionals'])->where('active', 1)->get();
        $contentadditionals = collect();

        foreach ($entries as $entry) {
            foreach ($entry->contentadditionals as $contentadditional) {
                if ($contentadditional->reminder) {
                    $contentadditionals->push($contentadditional);
                }
            }
        }

        $start = $request->start;
        $length = $request->length;

        $data = $contentadditionals->sortBy('reminder')->slice($start, $length);
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $contentadditionals->count(),
        	'recordsFiltered' => $contentadditionals->count(),
            'data' => $data
        ]);
    }

    public function add_to_cache(Request $request) {
        try {
            $entry = Entry::findOrFail($request->id);
            ProcessRedisStoreEntry::dispatch([$entry]);
    
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

}
