<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Language;
use App\Models\Entry;
use App\Models\Visa;
use App\Models\Inoculation;
use App\Models\Transitvisa;
use App\Jobs\ProcessRedisStoreEntry;
use App\Jobs\ProcessRedisStoreVisa;
use App\Jobs\ProcessRedisStoreInoculation;
use App\Jobs\ProcessRedisStoreTransitvisa;

class RedisController extends Controller
{
    public function sync()
    {
        $entries = Entry::where('active', 1)->with('nationalities')->get();
        $visas = Visa::where('active', 1)->with('nationalities')->get();
        $inoculations = Inoculation::where('active', 1)->get();
        $transitvisas = Transitvisa::where('active', 1)->with('nationalities')->get();

        ProcessRedisStoreEntry::dispatch($entries);
        ProcessRedisStoreVisa::dispatch($visas);
        ProcessRedisStoreInoculation::dispatch($inoculations);
        ProcessRedisStoreTransitvisa::dispatch($transitvisas);

        return back();
    }

    public function check()
    {
        $models = ['Entry', 'Visa', 'Inoculation', 'Transitvisa'];
        $countries = Country::where('active', 1)->get();
        $nationalities = Nationality::where('active', 1)->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        return view('cache.redis', compact('models', 'countries', 'nationalities', 'languages'));
    }

}
