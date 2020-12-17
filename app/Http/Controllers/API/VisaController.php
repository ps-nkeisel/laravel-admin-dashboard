<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\VisaFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Visa;
use App\Models\Nationality;
use App\Models\Language;
use App\Models\Useraction;
use App\Models\Visadocument;
use Carbon\Carbon;

class VisaController extends Controller
{
    public function search(Request $request) {
        $query = Visa::with(['createdUser', 'updatedUser', 'controlledUser']);

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

        $visas = $query->get();

        if (isset($filters['nationality_ids']) && sizeof($filters['nationality_ids'])) {
            $nationality_ids = $filters['nationality_ids'];

            $visas = $visas->reject(function ($visa, $key) use($nationality_ids) {
                $has_nat = true;
                foreach ($nationality_ids as $nat_id) {
                    if (!$visa->nationalities()->find($nat_id)) {
                        $has_nat = false;
                        break;
                    }
                }
                return !$has_nat;
            });

            $visas = $visas->values();
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
            $visas = $visas->sortBy($order_col);
        } else {
            $visas = $visas->sortByDesc($order_col);
        }
        $data = $visas->slice($start, $length);
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $visas->count(),
        	'recordsFiltered' => $visas->count(),
            'data' => $data
        ]);
    }

    public function search_nats(Request $request) {
        try {
            $visa = Visa::findOrFail($request->id);

            $columns = [];
            foreach ($request->columns as $col) {
                array_push($columns, $col['data']);
            }

            $order_col_index = $request->order[0]['column'];
            $order_col = $columns[$order_col_index];
            $order_dir = $request->order[0]['dir'];

            $start = $request->start;
            $length = $request->length;

            $query = $visa->nationalities();
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
        $query = Visa::with(['createdUser', 'updatedUser', 'controlledUser']);

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

    public function report(Request $request) {
        $visa = Visa::findOrFail($request->id);
        $language = Language::where('code', $request->lang)->firstOrFail();

        $report = $visa->getReport($language);

        return response()->json($report);
    }

    public function preview(VisaFormRequest $request) {
        $language = Language::where('code', 'en')->firstOrFail();
        return response()->json(Visa::getPreview($request, $language));
    }

    public function get_id(Request $request) {
        try {
            $visa = Visa::where('assignto', $request->assignto)->where('version', $request->version)->firstOrFail();
            return response()->json($visa->id);
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
            $visa1 = Visa::findOrFail($request->id1);
            $visa2 = Visa::findOrFail($request->id2);

            $nationalities = $visa1->nationalities->merge($visa2->nationalities);
            foreach ($visa1->nationalities as $nat1) {
                $nationalities->find($nat1->id)->active1 = true;
            }
            foreach ($visa2->nationalities as $nat2) {
                $nationalities->find($nat2->id)->active2 = true;
            }

            $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
            $contentadditionals_count = $visa1->contentadditionals->count();
            if ($visa2->contentadditionals->count() > $contentadditionals_count) {
                $contentadditionals_count = $visa2->contentadditionals->count();
            }
            $contentadditionals = [];
            for ($position = 1; $position <= $contentadditionals_count; $position ++) {
                $contentadditional1 = $visa1->contentadditionals()->with('languages')->where('position', $position)->first();
                $contentadditional2 = $visa2->contentadditionals()->with('languages')->where('position', $position)->first();
                array_push($contentadditionals, [
                    '1' => $contentadditional1,
                    '2' => $contentadditional2,
                ]);
            }

            return response()->json([
                'visa1' => $visa1,
                'visa2' => $visa2,
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
        $visa = Visa::findOrFail($request->visa_id);
        $visa->update([
            $request->key => $request->value
        ]);

        $useraction = new Useraction;
        $useraction->assigntype = 12;   // Visa
        $useraction->assigntonew = $visa->id;
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
        $useraction->code = $visa->countrytocode;
        $useraction->version = $visa->version;
        $useraction->created_user = $request->user_id;
        $useraction->created_ip = $request->ip();
        $useraction->save();
    }

    public function check_noinfos(Request $request) {
        $query = Visa::with(['createdUser', 'updatedUser', 'controlledUser']);

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

    public function check_require1(Request $request) {
        $filters = $request->filters;
        $require1 = $request->filters['require1'];

        $status = 'success';

        $nationalities = collect();
        $visas = collect();

        if (isset($filters['countrytocode'])) {
            $visas = Visa::with('nationalities')->where('active', 1)->where('countrytocode', $filters['countrytocode'])->get();
            if ($visas->count() == 0) {
                $status = 'error';
            } else {
                if (isset($filters['nationality_ids']) && sizeof($filters['nationality_ids'])) {
                    $nationalities = Nationality::where('active', 1)->find($filters['nationality_ids']);

                    foreach ($nationalities as $nationality) {
                        $nationality->require1 = 'yes';
                        foreach ($visas as $visa) {
                            if ($visa->nationalities->find($nationality->id)) {
                                if ($visa->require1 != $require1) {
                                    $nationality->require1 = 'no';
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
        $visas = Visa::with(['contentadditionals'])->where('active', 1)->get();
        $contentadditionals = collect();

        foreach ($visas as $visa) {
            foreach ($visa->contentadditionals as $contentadditional) {
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
        $visa = Visa::findOrFail($request->id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        if (!$visa->country) {
            abort(404);
        }
        $destco = $visa->country->code;
        foreach ($visa->nationalities as $nationality) {
            $nat = $nationality->code;
            foreach ($languages as $language) {
                $lang = $language->code;

                $cacheKeyVisa = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'VISA';
                $report = $visa->getReport2($language);
                $report['content'] = formatContent($report['content']);
                $visa_data = [
                    'id' => $visa->id,
                    'version' => $visa->version,
                    'status' => 'ok',
                    'language' => $lang,
                    'headline' => $report['title'],
                    'content' => $report['content'],
                ];
                Cache::store('redis')->put($cacheKeyVisa, $visa_data, Carbon::now()->addDays(config('cache.data_cache_visa')));
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ]);
    }

}
