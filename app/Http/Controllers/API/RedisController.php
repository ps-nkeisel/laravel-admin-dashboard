<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\EntryFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Language;
use App\Models\Entry;
use App\Models\Visa;
use App\Models\Inoculation;
use App\Models\Transitvisa;
use Carbon\Carbon;
use Exception;

class RedisController extends Controller
{
    public function check(Request $request) {
        try {
            $model = $request->model;
            $destco = $request->destco;
            $nat = $request->nat;
            $lang = $request->lang;

            $cacheKey = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.strtoupper($model);
            if (Cache::store('redis')->has($cacheKey)) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Record exist in cache',
                ]);
            }

            return response()->json([
                'code' => 404,
                'message' => 'Not exist'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function store(Request $request) {
        try {
            $model = $request->model;
            $destco = $request->destco;
            $nat = $request->nat;
            $lang = $request->lang;

            $cacheKey = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.strtoupper($model);
            $cacheValue = null;
            $expiresAt = null;

            $language = Language::where('code', $lang)->firstOrFail();
            $data = null;

            if ($model == 'Entry') {
                $data = Entry::where('countrytocode', $destco)
                    ->with(['nationalities' => function ($que) use ($nat) {
                        $que->where('code', $nat);
                    }])
                    ->firstOrFail();
                $expiresAt = Carbon::now()->addDays(config('cache.data_cache_entry'));
            } else if ($model == 'Visa') {
                $data = Visa::where('countrytocode', $destco)
                    ->with(['nationalities' => function ($que) use ($nat) {
                        $que->where('code', $nat);
                    }])
                    ->firstOrFail();
                $expiresAt = Carbon::now()->addDays(config('cache.data_cache_visa'));
            } else if ($model == 'Inoculation') {
                $data = Inoculation::where('countrytocode', $destco)->firstOrFail();
                $expiresAt = Carbon::now()->addDays(config('cache.data_cache_health'));
            } else if ($model == 'Visa') {
                $data = Transitvisa::where('countrytocode', $destco)
                    ->with(['nationalities' => function ($que) use ($nat) {
                        $que->where('code', $nat);
                    }])
                    ->firstOrFail();
                $expiresAt = Carbon::now()->addDays(config('cache.data_cache_transitvisa'));
            }

            if ($data == null) {
                throw new \Exception('Not exist');
            }

            $report = $data->getReport2($language);
            $report['content'] = formatContent($report['content']);

            $cacheValue = [
                'id' => $data->id,
                'version' => $data->version,
                'status' => 'ok',
                'language' => $lang,
                'headline' => $report['title'],
                'content' => $report['content'],
            ];

            Cache::store('redis')->put($cacheKey, $cacheValue, $expiresAt);

            return response()->json([
                'code' => 200,
                'message' => 'Record cached into Redis Store',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function sync_store(Request $request) {
        // $req_body = json_decode($request->getContent(), true);

        // $entry_ids = $req_body['entry_ids'];

        // $query = Entry::where('active', 1)->with('nationalities');
        // if (isset($entry_ids) && count($entry_ids) > 0) {
        //     $query->whereIn('id', $entry_ids);
        // }
        // $entries = $query->get();

        $entries = Entry::where('active', 1)->with('nationalities')->get();
        cacheEntriesIntoRedisStore($entries);
        $visas = Visa::where('active', 1)->with('nationalities')->get();
        cacheVisasIntoRedisStore($visas);
        $inoculations = Inoculation::where('active', 1)->get();
        cacheInoculationsIntoRedisStore($inoculations);
        $transitvisas = Transitvisa::where('active', 1)->with('nationalities')->get();
        cacheTransitvisasIntoRedisStore($transitvisas);
    }

}
