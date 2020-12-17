<?php

use Illuminate\Support\Facades\Cache;
use App\Models\Language;
use App\Models\Entry;
use App\Models\Visa;
use App\Models\Inoculation;
use App\Models\Transitvisa;

if (!function_exists('cacheEntriesIntoRedisStore')) {
    function cacheEntriesIntoRedisStore($entries)
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        if (count($languages) == 0) {
            return;
        }

        $entries_data = [];
        foreach ($entries as $entry) {
            if (!$entry->country || count($entry->nationalities) == 0) {
                continue;
            }

            $destco = $entry->country->code;
            $nat = $entry->nationalities->first()->code;
            $lang = $languages->first()->code;
            $cacheKeyEntry = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'ENTRY';
            if (Cache::store('redis')->has($cacheKeyEntry)) {
                $old_entry = Cache::store('redis')->get($cacheKeyEntry);
                if ($old_entry['id'] == $entry->id) {
                    continue;
                }
            }

            foreach ($languages as $language) {
                $lang = $language->code;
                $report = $entry->getReport2($language);
                $report['content'] = formatContent($report['content']);

                foreach ($entry->nationalities as $nationality) {
                    $nat = $nationality->code;
                    $cacheKeyEntry = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'ENTRY';
                    $entries_data[$cacheKeyEntry] = [
                        'id' => $entry->id,
                        'version' => $entry->version,
                        'status' => 'ok',
                        'language' => $lang,
                        'headline' => $report['title'],
                        'content' => $report['content'],
                    ];
                }
            }
        }

        if (count($entries_data) > 0) {
            Cache::store('redis')->putMany($entries_data, Carbon::now()->addDays(config('cache.data_cache_entry')));
        }
    }
}

if (!function_exists('cacheVisasIntoRedisStore')) {
    function cacheVisasIntoRedisStore($visas)
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        if (count($languages) == 0) {
            return;
        }

        $visas_data = [];
        foreach ($visas as $visa) {
            if (!$visa->country || count($visa->nationalities) == 0) {
                continue;
            }
            $destco = $visa->country->code;
            $nat = $visa->nationalities->first()->code;
            $lang = $languages->first()->code;
            $cacheKeyVisa = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'VISA';
            if (Cache::store('redis')->has($cacheKeyVisa)) {
                $old_visa = Cache::store('redis')->get($cacheKeyVisa);
                if ($old_visa['id'] == $visa->id) {
                    continue;
                }
            }

            foreach ($languages as $language) {
                $lang = $language->code;
                $report = $visa->getReport2($language);
                $report['content'] = formatContent($report['content']);

                foreach ($visa->nationalities as $nationality) {
                    $nat = $nationality->code;
                    $cacheKeyVisa = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'VISA';
                    $visas_data[$cacheKeyVisa] = [
                        'id' => $visa->id,
                        'version' => $visa->version,
                        'status' => 'ok',
                        'language' => $lang,
                        'headline' => $report['title'],
                        'content' => $report['content'],
                    ];
                }
            }
        }

        if (count($visas_data) > 0) {
            Cache::store('redis')->putMany($visas_data, Carbon::now()->addDays(config('cache.data_cache_visa')));
        }
    }
}

if (!function_exists('cacheInoculationsIntoRedisStore')) {
    function cacheInoculationsIntoRedisStore($inoculations)
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        if (count($languages) == 0) {
            return;
        }

        $inoculations_data = [];
        foreach ($inoculations as $inoculation) {
            if (!$inoculation->country) {
                continue;
            }
            $destco = $inoculation->country->code;
            $lang = $languages->first()->code;
            $cacheKeyInoculation = strtoupper($destco).'-'.strtoupper($lang).'-'.'HEALTH';
            if (Cache::store('redis')->has($cacheKeyInoculation)) {
                $old_inoculation = Cache::store('redis')->get($cacheKeyInoculation);
                if ($old_inoculation['id'] == $inoculation->id) {
                    continue;
                }
            }

            foreach ($languages as $language) {
                $lang = $language->code;
                $report = $inoculation->getReport2($language);
                $report['content'] = formatContent($report['content']);

                $cacheKeyInoculation = strtoupper($destco).'-'.strtoupper($lang).'-'.'HEALTH';
                $inoculations_data[$cacheKeyInoculation] = [
                    'id' => $inoculation->id,
                    'version' => $inoculation->version,
                    'status' => 'ok',
                    'language' => $lang,
                    'headline' => $report['title'],
                    'content' => $report['content'],
                ];
            }
        }

        if (count($inoculations_data) > 0) {
            Cache::store('redis')->putMany($inoculations_data, Carbon::now()->addDays(config('cache.data_cache_health')));
        }
    }
}

if (!function_exists('cacheTransitvisasIntoRedisStore')) {
    function cacheTransitvisasIntoRedisStore($transitvisas)
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        if (count($languages) == 0) {
            return;
        }

        $transitvisas_data = [];
        foreach ($transitvisas as $transitvisa) {
            if (!$transitvisa->country || count($transitvisa->nationalities) == 0) {
                continue;
            }
            $destco = $transitvisa->country->code;
            $nat = $transitvisa->nationalities->first()->code;
            $lang = $languages->first()->code;
            $cacheKeyTransitvisa = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'TRANSITVISA';
            if (Cache::store('redis')->has($cacheKeyTransitvisa)) {
                $old_transitvisa = Cache::store('redis')->get($cacheKeyTransitvisa);
                if ($old_transitvisa['id'] == $transitvisa->id) {
                    continue;
                }
            }

            foreach ($languages as $language) {
                $lang = $language->code;
                $report = $transitvisa->getReport2($language);
                $report['content'] = formatContent($report['content']);

                foreach ($transitvisa->nationalities as $nationality) {
                    $nat = $nationality->code;
                    $cacheKeyTransitvisa = strtoupper($destco).'-'.strtoupper($nat).'-'.strtoupper($lang).'-'.'TRANSITVISA';
                    $transitvisas_data[$cacheKeyTransitvisa] = [
                        'id' => $transitvisa->id,
                        'version' => $transitvisa->version,
                        'status' => 'ok',
                        'language' => $lang,
                        'headline' => $report['title'],
                        'content' => $report['content'],
                    ];
                }
            }
        }

        if (count($transitvisas_data) > 0) {
            Cache::store('redis')->putMany($transitvisas_data, Carbon::now()->addDays(config('cache.data_cache_transitvisa')));
        }
    }
}
