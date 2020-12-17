<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\InoculationFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Inoculation;
use App\Models\Content;
use App\Models\Immunisation;
use App\Models\Inooptionchild;
use App\Models\Inooptionpregnant;
use App\Models\Inoculationspecific;
use App\Models\Language;
use App\Models\Useraction;
use Carbon\Carbon;

class InoculationController extends Controller
{
    public function search(Request $request) {
        $query = Inoculation::with(['createdUser', 'updatedUser', 'controlledUser']);

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

    public function search_versions(Request $request) {
        $query = Inoculation::with(['createdUser', 'updatedUser', 'controlledUser']);

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
        $inoculation = Inoculation::findOrFail($request->id);
        $language = Language::where('code', $request->lang)->firstOrFail();

        $report = $inoculation->getReport($language);

        return response()->json($report);
    }

    public function preview(InoculationFormRequest $request) {
        $language = Language::where('code', 'en')->firstOrFail();
        return response()->json(Inoculation::getPreview($request, $language));
    }

    public function get_id(Request $request) {
        try {
            $inoculation = Inoculation::where('assignto', $request->assignto)->where('version', $request->version)->firstOrFail();
            return response()->json($inoculation->id);
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
            $inoculation1 = Inoculation::findOrFail($request->id1);
            $inoculation2 = Inoculation::findOrFail($request->id2);

            $requirement_immunisations = Immunisation::orderBy('position', 'asc')->get();
            foreach ($requirement_immunisations as $key => $immunisation) {
                $requirement_immunisation1 = $inoculation1->requirement_immunisations()->find($immunisation->id);
                if ($requirement_immunisation1) {
                    $immunisation->active1 = $requirement_immunisation1->pivot->active;
                    $immunisation->lts1 = $requirement_immunisation1->pivot->longtermstay;
                    $immunisation->se1 = $requirement_immunisation1->pivot->specialexposure;
                }
                $requirement_immunisation2 = $inoculation2->requirement_immunisations()->find($immunisation->id);
                if ($requirement_immunisation2) {
                    $immunisation->active2 = $requirement_immunisation2->pivot->active;
                    $immunisation->lts2 = $requirement_immunisation2->pivot->longtermstay;
                    $immunisation->se2 = $requirement_immunisation2->pivot->specialexposure;
                }
                if (!$immunisation->active1 && !$immunisation->active2) {
                    unset($requirement_immunisations[$key]);
                }
            }

            $recommendation_immunisations = Immunisation::orderBy('position', 'asc')->get();
            foreach ($recommendation_immunisations as $key => $immunisation) {
                $recommendation_immunisation1 = $inoculation1->recommendation_immunisations()->find($immunisation->id);
                if ($recommendation_immunisation1) {
                    $immunisation->active1 = $recommendation_immunisation1->pivot->active;
                    $immunisation->lts1 = $recommendation_immunisation1->pivot->longtermstay;
                    $immunisation->se1 = $recommendation_immunisation1->pivot->specialexposure;
                }
                $recommendation_immunisation2 = $inoculation2->recommendation_immunisations()->find($immunisation->id);
                if ($recommendation_immunisation2) {
                    $immunisation->active2 = $recommendation_immunisation2->pivot->active;
                    $immunisation->lts2 = $recommendation_immunisation2->pivot->longtermstay;
                    $immunisation->se2 = $recommendation_immunisation2->pivot->specialexposure;
                }
                if (!$immunisation->active1 && !$immunisation->active2) {
                    unset($recommendation_immunisations[$key]);
                }
            }

            $optionpregnants = Inooptionpregnant::orderBy('position', 'asc')->get();
            foreach ($optionpregnants as $key => $optionpregnant) {
                $optionpregnant1 = $inoculation1->optionpregnants()->find($optionpregnant->id);
                if ($optionpregnant1) {
                    $optionpregnant->active1 = $optionpregnant1->pivot->active;
                }
                $optionpregnant2 = $inoculation2->optionpregnants()->find($optionpregnant->id);
                if ($optionpregnant2) {
                    $optionpregnant->active2 = $optionpregnant2->pivot->active;
                }
                if (!$optionpregnant->active1 && !$optionpregnant->active2) {
                    unset($optionpregnants[$key]);
                }
            }

            $optionchildren = Inooptionchild::orderBy('position', 'asc')->get();
            foreach ($optionchildren as $key => $optionchild) {
                $optionchild1 = $inoculation1->optionchildren()->find($optionchild->id);
                if ($optionchild1) {
                    $optionchild->active1 = $optionchild1->pivot->active;
                }
                $optionchild2 = $inoculation2->optionchildren()->find($optionchild->id);
                if ($optionchild2) {
                    $optionchild->active2 = $optionchild2->pivot->active;
                }
                if (!$optionchild->active1 && !$optionchild->active2) {
                    unset($optionchildren[$key]);
                }
            }

            $inoculationspecifics = Inoculationspecific::orderBy('position', 'asc')->get();
            foreach ($inoculationspecifics as $key => $inoculationspecific) {
                $inoculationspecific1 = $inoculation1->inoculationspecifics()->find($inoculationspecific->id);
                if ($inoculationspecific1) {
                    $inoculationspecific->active1 = $inoculationspecific1->pivot->active;
                }
                $inoculationspecific2 = $inoculation2->inoculationspecifics()->find($inoculationspecific->id);
                if ($inoculationspecific2) {
                    $inoculationspecific->active2 = $inoculationspecific2->pivot->active;
                }
                if (!$inoculationspecific->active1 && !$inoculationspecific->active2) {
                    unset($inoculationspecifics[$key]);
                }
            }

            $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
            $contentadditionals_count = $inoculation1->contentadditionals->count();
            if ($inoculation2->contentadditionals->count() > $contentadditionals_count) {
                $contentadditionals_count = $inoculation2->contentadditionals->count();
            }
            $contentadditionals = [];
            for ($position = 1; $position <= $contentadditionals_count; $position ++) {
                $contentadditional1 = $inoculation1->contentadditionals()->with('languages')->where('position', $position)->first();
                $contentadditional2 = $inoculation2->contentadditionals()->with('languages')->where('position', $position)->first();
                array_push($contentadditionals, [
                    '1' => $contentadditional1,
                    '2' => $contentadditional2,
                ]);
            }

            return response()->json([
                'inoculation1' => $inoculation1,
                'inoculation2' => $inoculation2,
                'requirement_immunisations' => $requirement_immunisations,
                'recommendation_immunisations' => $recommendation_immunisations,
                'optionpregnants' => $optionpregnants,
                'optionchildren' => $optionchildren,
                'inoculationspecifics' => $inoculationspecifics,
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
        $inoculation = Inoculation::findOrFail($request->inoculation_id);
        $inoculation->update([
            $request->key => $request->value
        ]);

        $useraction = new Useraction;
        $useraction->assigntype = 17;   // Inoculation
        $useraction->assigntonew = $inoculation->id;
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
        $useraction->code = $inoculation->countrytocode;
        $useraction->version = $inoculation->version;
        $useraction->created_user = $request->user_id;
        $useraction->created_ip = $request->ip();
        $useraction->save();
    }

    public function check_noinfos(Request $request) {
        $query = Inoculation::with(['createdUser', 'updatedUser', 'controlledUser']);

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

    public function check_reminder(Request $request) {
        $inoculations = Inoculation::with(['contentadditionals'])->where('active', 1)->get();
        $contentadditionals = collect();

        foreach ($inoculations as $inoculation) {
            foreach ($inoculation->contentadditionals as $contentadditional) {
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
        $inoculation = Inoculation::findOrFail($request->id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        if (!$inoculation->country) {
            abort(404);
        }
        $destco = $inoculation->country->code;
        foreach ($languages as $language) {
            $lang = $language->code;

            $cacheKeyInoculation = strtoupper($destco).'-'.strtoupper($lang).'-'.'HEALTH';
            $report = $inoculation->getReport2($language);
            $report['content'] = formatContent($report['content']);
            $inoculation_data = [
                'id' => $inoculation->id,
                'version' => $inoculation->version,
                'status' => 'ok',
                'language' => $lang,
                'headline' => $report['title'],
                'content' => $report['content'],
            ];
            Cache::store('redis')->put($cacheKeyInoculation, $inoculation_data, Carbon::now()->addDays(config('cache.data_cache_health')));
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ]);
    }

}
