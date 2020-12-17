<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\TransitvisaFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Transitvisa;
use App\Models\Language;
use App\Models\Useraction;
use Carbon\Carbon;

class TransitvisaController extends Controller
{
    public function search(Request $request) {
        $query = Transitvisa::with(['createdUser', 'updatedUser', 'controlledUser']);

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

        $transitvisas = $query->get();

        if (isset($filters['nationality_ids']) && sizeof($filters['nationality_ids'])) {
            $nationality_ids = $filters['nationality_ids'];

            $transitvisas = $transitvisas->reject(function ($transitvisa, $key) use($nationality_ids) {
                $has_nat = true;
                foreach ($nationality_ids as $nat_id) {
                    if (!$transitvisa->nationalities()->find($nat_id)) {
                        $has_nat = false;
                        break;
                    }
                }
                return !$has_nat;
            });

            $transitvisas = $transitvisas->values();
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
            $transitvisas = $transitvisas->sortBy($order_col);
        } else {
            $transitvisas = $transitvisas->sortByDesc($order_col);
        }
        $data = $transitvisas->slice($start, $length);
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $transitvisas->count(),
        	'recordsFiltered' => $transitvisas->count(),
            'data' => $data
        ]);
    }

    public function search_nats(Request $request) {
        try {
            $transitvisa = Transitvisa::findOrFail($request->id);

            $columns = [];
            foreach ($request->columns as $col) {
                array_push($columns, $col['data']);
            }

            $order_col_index = $request->order[0]['column'];
            $order_col = $columns[$order_col_index];
            $order_dir = $request->order[0]['dir'];

            $start = $request->start;
            $length = $request->length;

            $query = $transitvisa->nationalities();
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
        $query = Transitvisa::with(['createdUser', 'updatedUser', 'controlledUser']);

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
            $transitvisa = Transitvisa::where('assignto', $request->assignto)->where('version', $request->version)->firstOrFail();
            return response()->json($transitvisa->id);
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
            $transitvisa1 = Transitvisa::findOrFail($request->id1);
            $transitvisa2 = Transitvisa::findOrFail($request->id2);

            $nationalities = $transitvisa1->nationalities->merge($transitvisa2->nationalities);
            foreach ($transitvisa1->nationalities as $nat1) {
                $nationalities->find($nat1->id)->active1 = true;
            }
            foreach ($transitvisa2->nationalities as $nat2) {
                $nationalities->find($nat2->id)->active2 = true;
            }

            return response()->json([
                'transitvisa1' => $transitvisa1,
                'transitvisa2' => $transitvisa2,
                'nationalities' => $nationalities,
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
        $transitvisa = Transitvisa::findOrFail($request->transitvisa_id);
        $transitvisa->update([
            $request->key => $request->value
        ]);

        $useraction = new Useraction;
        $useraction->assigntype = 4;   // Transitvisa
        $useraction->assigntonew = $transitvisa->id;
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
        $useraction->code = $transitvisa->countrytocode;
        $useraction->version = $transitvisa->version;
        $useraction->created_user = $request->user_id;
        $useraction->created_ip = $request->ip();
        $useraction->save();
    }

    public function report(Request $request) {
        $transitvisa = Transitvisa::findOrFail($request->id);
        $language = Language::where('code', $request->lang)->firstOrFail();

        $report = $transitvisa->getReport($language);

        return response()->json($report);
    }

    public function preview(TransitvisaFormRequest $request) {
        $language = Language::where('code', 'en')->firstOrFail();
        return response()->json(Transitvisa::getPreview($request, $language));
    }

    public function check_reminder(Request $request) {
        $transitvisas = Transitvisa::with(['contentadditionals'])->where('active', 1)->get();
        $contentadditionals = collect();

        foreach ($transitvisas as $transitvisa) {
            foreach ($transitvisa->contentadditionals as $contentadditional) {
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
        $transitvisa = Transitvisa::findOrFail($request->id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        if (!$transitvisa->country) {
            abort(404);
        }
        $destco = $transitvisa->country->code;
        foreach ($transitvisa->nationalities as $nationality) {
            $nat = $nationality->code;
            foreach ($languages as $language) {
                $lang = $language->code;

                $cacheKeyTransitvisa = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'TRANSITVISA';
                $report = $transitvisa->getReport2($language);
                $report['content'] = formatContent($report['content']);
                $transitvisa_data = [
                    'id' => $transitvisa->id,
                    'version' => $transitvisa->version,
                    'status' => 'ok',
                    'language' => $lang,
                    'headline' => $report['title'],
                    'content' => $report['content'],
                ];
                Cache::store('redis')->put($cacheKeyTransitvisa, $transitvisa_data, Carbon::now()->addDays(config('cache.data_cache_transitvisa')));
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ]);
    }

}
