<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\CruisetuicFormRequest;
use Illuminate\Http\Request;
use App\Models\Cruisetuic;
use App\Models\Language;
use App\Models\Useraction;

class CruisetuicController extends Controller
{
    public function search(Request $request) {
        $query = Cruisetuic::with(['createdUser', 'updatedUser', 'controlledUser']);

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

        $cruisetuics = $query->get();

        if (isset($filters['nationality_ids']) && sizeof($filters['nationality_ids'])) {
            $nationality_ids = $filters['nationality_ids'];

            $cruisetuics = $cruisetuics->reject(function ($cruisetuic, $key) use($nationality_ids) {
                $has_nat = true;
                foreach ($nationality_ids as $nat_id) {
                    if (!$cruisetuic->nationalities()->find($nat_id)) {
                        $has_nat = false;
                        break;
                    }
                }
                return !$has_nat;
            });

            $cruisetuics = $cruisetuics->values();
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
            $cruisetuics = $cruisetuics->sortBy($order_col);
        } else {
            $cruisetuics = $cruisetuics->sortByDesc($order_col);
        }
        $data = $cruisetuics->slice($start, $length);
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $cruisetuics->count(),
        	'recordsFiltered' => $cruisetuics->count(),
            'data' => $data
        ]);
    }

    public function search_nats(Request $request) {
        try {
            $cruisetuic = Cruisetuic::findOrFail($request->id);

            $columns = [];
            foreach ($request->columns as $col) {
                array_push($columns, $col['data']);
            }

            $order_col_index = $request->order[0]['column'];
            $order_col = $columns[$order_col_index];
            $order_dir = $request->order[0]['dir'];

            $start = $request->start;
            $length = $request->length;

            $query = $cruisetuic->nationalities();
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
        $query = Cruisetuic::with(['createdUser', 'updatedUser', 'controlledUser']);

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
        $cruisetuic = Cruisetuic::findOrFail($request->id);
        $language = Language::where('code', $request->lang)->firstOrFail();

        $report = $cruisetuic->getReport($language);

        return response()->json($report);
    }

    public function preview(CruisetuicFormRequest $request) {
        $language = Language::where('code', 'en')->firstOrFail();
        return response()->json(Cruisetuic::getPreview($request, $language));
    }

    public function get_id(Request $request) {
        try {
            $cruisetuic = Cruisetuic::where('assignto', $request->assignto)->where('version', $request->version)->firstOrFail();
            return response()->json($cruisetuic->id);
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
            $cruisetuic1 = Cruisetuic::findOrFail($request->id1);
            $cruisetuic2 = Cruisetuic::findOrFail($request->id2);

            $nationalities = $cruisetuic1->nationalities->merge($cruisetuic2->nationalities);
            foreach ($cruisetuic1->nationalities as $nat1) {
                $nationalities->find($nat1->id)->active1 = true;
            }
            foreach ($cruisetuic2->nationalities as $nat2) {
                $nationalities->find($nat2->id)->active2 = true;
            }

            $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
            $contentadditionals_count = $cruisetuic1->contentadditionals->count();
            if ($cruisetuic2->contentadditionals->count() > $contentadditionals_count) {
                $contentadditionals_count = $cruisetuic2->contentadditionals->count();
            }
            $contentadditionals = [];
            for ($position = 1; $position <= $contentadditionals_count; $position ++) {
                $contentadditional1 = $cruisetuic1->contentadditionals()->with('languages')->where('position', $position)->first();
                $contentadditional2 = $cruisetuic2->contentadditionals()->with('languages')->where('position', $position)->first();
                array_push($contentadditionals, [
                    '1' => $contentadditional1,
                    '2' => $contentadditional2,
                ]);
            }

            return response()->json([
                'cruisetuic1' => $cruisetuic1,
                'cruisetuic2' => $cruisetuic2,
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
        $cruisetuic = Cruisetuic::findOrFail($request->cruisetuic_id);
        $cruisetuic->update([
            $request->key => $request->value
        ]);

        $useraction = new Useraction;
        $useraction->assigntype = 29;   // Cruisetuic
        $useraction->assigntonew = $cruisetuic->id;
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
        $useraction->code = $cruisetuic->countrytocode;
        $useraction->version = $cruisetuic->version;
        $useraction->created_user = $request->user_id;
        $useraction->created_ip = $request->ip();
        $useraction->save();
    }

}
