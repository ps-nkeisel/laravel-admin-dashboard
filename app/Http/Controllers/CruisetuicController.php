<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CruisetuicFormRequest;
use App\Models\Cruisetuic;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Language;
use App\Models\Contentadditional;
use App\Models\Useraction;
use Exception;
use Auth;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Log;
use Carbon\Carbon;
use Storage;

class CruisetuicController extends Controller
{
    /**
     * Display a listing of the cruisetuics.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $nationalities = Nationality::where('active', 1)->get();

        $obj = (object) [
            'nationalities' => $nationalities
        ];
        $json = \GuzzleHttp\json_encode($obj);
        Log::debug($json);

        return view('cruisetuics.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $nationalities = Nationality::where('active', 1)->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $contentgroups = Cruisetuic::contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        Log::info("TUI Cruises record created! This will show up as log level INFO!");

        return view('cruisetuics.create', compact('nationalities', 'languages', 'contentgroups',
            'translation_status'));
    }

    /**
     * Store a new cruisetuic in the storage.
     *
     * @param  App\Http\Requests\CruisetuicFormRequest  $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CruisetuicFormRequest $request)
    {
        try {

            $data = $request->getData();

            $cruisetuic = Cruisetuic::create($data);

            $country = Country::where('code', $cruisetuic->countrytocode)->first();
            if ($country) {
                $cruisetuic->idcountry = $country->id;
            }

            $cruisetuic->created_user = Auth::user()->id;
            $cruisetuic->created_ip = $request->ip();
            $cruisetuic->version = 1;
            $cruisetuic->assignto = $cruisetuic->id;
            $cruisetuic->idversionbefore = 0;
            $cruisetuic->idversionnext = 0;
            $cruisetuic->save();

            $cruisetuic->nationalities()->attach($request->nationality_ids);

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                $contentadditional = new Contentadditional;

                $contentadditional->position = $position;
                $contentadditional->contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? 0;
                $contentadditional->reminder = $contentadditionalsParam['reminders'][$position] ? Carbon::parse($contentadditionalsParam['reminders'][$position]) : null;
                $contentadditional->created_user = Auth::user()->id;
                $contentadditional->created_ip = $request->ip();
                $contentadditional->active = 1;
                $contentadditional->archive = 0;

                $cruisetuic->contentadditionals()->save($contentadditional);

                $languages = [];
                foreach ($headlines as $lang => $headline) {
                    $content = $contentadditionalsParam['languageContents'][$position][$lang];
                    $translatedfrom = $contentadditionalsParam['translatedfroms'][$position][$lang];
                    $main = (isset($contentadditionalsParam['languageMains'][$position]) && count($contentadditionalsParam['languageMains'][$position]) == 1 && $contentadditionalsParam['languageMains'][$position][0] == $lang);
                    $languages[$lang] = [
                        'headline' => $headline,
                        'content' => $content,
                        'translatedfrom' => $translatedfrom,
                        'main' => $main,
                    ];
                }
                $contentadditional->languages()->sync($languages);
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $cruisetuic->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 29;   // TUI Cruise
            $useraction->comment = '';
            $useraction->code = $cruisetuic->countrytocode;
            $useraction->version = $cruisetuic->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            Log::info("TUI Cruises record stored! This will show up as log level INFO!");

            return redirect()->route('cruisetuics.show', $cruisetuic->id)
                ->with('success_message', 'Cruisetuic was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified
     *
     * @param  int  $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $cruisetuic = Cruisetuic::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $contentgroups = Cruisetuic::contentgroups()->get();

        foreach ($contentgroups as $contentgroup) {
            $contentgroup->contentadditionals = $cruisetuic->contentadditionals->where('contentgroup_id', $contentgroup->id);
        }

        Log::info("TUI Cruises record read! This will show up as log level INFO!");

        return view('cruisetuics.show', compact('cruisetuic', 'languages', 'contentgroups'));
    }

    /**
     * Show the form for editing the specified
     *
     * @param  int  $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $cruisetuic = Cruisetuic::findOrFail($id);
        $nationalities = Nationality::where('active', 1)->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $contentgroups = Cruisetuic::contentgroups()->get();

        foreach ($cruisetuic->nationalities as $vnat) {
            $nationality = $nationalities->find($vnat->id);
            $nationality->selected = true;
        }
        foreach ($contentgroups as $contentgroup) {
            $contentgroup->contentadditionals = $cruisetuic->contentadditionals->where('contentgroup_id', $contentgroup->id);
        }

        $translation_status = getTranslationStatusArray();

        Log::info("TUI Cruises record changed! This will show up as log level INFO!");

        return view('cruisetuics.edit', compact('cruisetuic', 'nationalities', 'languages', 'contentgroups',
            'translation_status'));
    }

    /**
     * Update the specified cruisetuic in the storage.
     *
     * @param  int  $id
     * @param  App\Http\Requests\CruisetuicFormRequest  $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CruisetuicFormRequest $request)
    {
        try {

            $data = $request->getData();

            $old_cruisetuic = Cruisetuic::findOrFail($id);
            $cruisetuic = $old_cruisetuic->replicate();
            $cruisetuic->push();
            $cruisetuic->update($data);

            $country = Country::where('code', $cruisetuic->countrytocode)->first();
            if ($country) {
                $cruisetuic->idcountry = $country->id;
            }
            $cruisetuic->version ++;
            $cruisetuic->created_user = Auth::user()->id;
            $cruisetuic->created_ip = $request->ip();
            $cruisetuic->assignto = $old_cruisetuic->assignto;
            $cruisetuic->idversionbefore = $old_cruisetuic->id;
            $cruisetuic->idversionnext = 0;
            $cruisetuic->save();

            $old_cruisetuic->active = 0;
            $old_cruisetuic->archive = 1;
            $old_cruisetuic->updated_user = Auth::user()->id;
            $old_cruisetuic->updated_ip = $request->ip();
            $old_cruisetuic->idversionnext = $cruisetuic->id;
            $old_cruisetuic->contentadditionals()->update([
                'active' => 0,
                'archive' => 1
            ]);
            $old_cruisetuic->save();

            $cruisetuic->nationalities()->attach($request->nationality_ids);

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                $contentadditional = new Contentadditional;

                $contentadditional->position = $position;
                $contentadditional->contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? 0;
                $contentadditional->reminder = $contentadditionalsParam['reminders'][$position] ? Carbon::parse($contentadditionalsParam['reminders'][$position]) : null;
                $contentadditional->created_user = Auth::user()->id;
                $contentadditional->created_ip = $request->ip();
                $contentadditional->active = 1;
                $contentadditional->archive = 0;

                $cruisetuic->contentadditionals()->save($contentadditional);

                $languages = [];
                foreach ($headlines as $lang => $headline) {
                    $content = $contentadditionalsParam['languageContents'][$position][$lang];
                    $translatedfrom = $contentadditionalsParam['translatedfroms'][$position][$lang];
                    $main = (isset($contentadditionalsParam['languageMains'][$position]) && count($contentadditionalsParam['languageMains'][$position]) == 1 && $contentadditionalsParam['languageMains'][$position][0] == $lang);
                    $languages[$lang] = [
                        'headline' => $headline,
                        'content' => $content,
                        'translatedfrom' => $translatedfrom,
                        'main' => $main,
                    ];
                }
                $contentadditional->languages()->sync($languages);
            }

            $useraction = new Useraction;
            $useraction->assigntoold = $old_cruisetuic->id;
            $useraction->assigntonew = $cruisetuic->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 29;   // TUI Cruise
            $useraction->comment = '';
            $useraction->code = $cruisetuic->countrytocode;
            $useraction->version = $cruisetuic->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            Log::info("TUI Cruises record updated! This will show up as log level INFO!");

            return redirect()->route('cruisetuics.show', $cruisetuic->id)
                ->with('success_message', 'Cruisetuic was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function sync()
    {
        try {
            $request = new Client();

            // $url = 'https://cmware.tuicruises.com/ws/passolution/routes';
            $url = 'https://cmware-test.tuicruises.com/ws/passolution/routes';

            $response = $request->request('GET', $url, [
                'auth' => [
                    config('app.tuic_route_api_user'),
                    config('app.tuic_route_api_password')
                ]
            ]);

            $result = $response->getBody(true);

            $result = json_decode($result, true);


            $routes = $result['routes'];
            $messages = [];

            foreach ($routes as $route) {
                $countries = $route['countries'];
                $scrcode = implode('_', $countries);
                $scrcodeext = $route['routeCode'];
                $scrname = $route['routeName'];

                $cruisetuics = CruiseTuic::where('scrcodeext', 'LIKE', "%{$scrcodeext}%")->get();
                if ($cruisetuics->count() > 0) {
                    foreach ($cruisetuics as $cruisetuic) {
                        if ($scrcode != $cruisetuic->scrcode) {
                            $arr_scrcodeext = explode(',', $cruisetuic->scrcodeext);
                            if (in_array($scrcodeext, $arr_scrcodeext)) {
                                $key = array_search($scrcodeext, $arr_scrcodeext);
                                unset($arr_scrcodeext[$key]);

                                $cruisetuic->scrcodeext = implode(',', $arr_scrcodeext);

                                $cruisetuic->save();

                                $message = "routeCode = \"$scrcodeext\" has been updated from scrcode \"$cruisetuic->scrcode\" to \"$scrcode\"";
                                array_push($messages, $message);
                            }
                        }
                    }
                }

                $cruisetuic = CruiseTuic::where('scrcode', $scrcode)->first();
                if ($cruisetuic) {
                    $arr_scrcodeext = explode(',', $cruisetuic->scrcodeext);
                    if (!in_array($scrcodeext, $arr_scrcodeext)) {
                        $cruisetuic->scrcodeext .= ','.$scrcodeext;
                        $cruisetuic->scrname .= ','.$scrname;
                        $cruisetuic->save();

                        $message = "route with routeCode = \"$scrcodeext\" has been added to scrcode = \"$scrcode\"\n".
                            "so scrcode = \"$scrcode\" has routeCodes \"$cruisetuic->scrcodeext\"";
                        array_push($messages, $message);
                    }
                } else {
                    $cruisetuic = CruiseTuic::create([
                        'scrcode' => $scrcode,
                        'scrcodeext' => $scrcodeext,
                        'scrname' => $scrname,
                    ]);

                    $message = "new route with scrcode = \"$scrcode\" has been created with routeCode = \"$scrcodeext\"";
                    array_push($messages, $message);
                }
            }

            $cruisetuics = CruiseTuic::all();

            return view('cruisetuics.sync', compact('cruisetuics', 'messages'));

        } catch (RequestException $e) {
            $cruisetuics = CruiseTuic::all();

            return view('cruisetuics.sync', compact('cruisetuics'))
                ->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function report($id, Request $request)
    {
        try {
            $cruisetuic = Cruisetuic::findOrFail($id);
            $language = Language::where('code', $request->lang)->firstOrFail();

            $report = $cruisetuic->getReport($language);

            $pdf = PDF::loadView('layouts.pdf.report', $report);

            Log::info("TUI Cruises report created! This will show up as log level INFO!");

            return $pdf->stream();
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

    public function preview(CruisetuicFormRequest $request)
    {
        try {
            $language = Language::where('code', 'en')->firstOrFail();
            $preview = Cruisetuic::getPreview($request, $language);

            $pdf = PDF::loadView('layouts.pdf.report', $preview);

            Log::info("TUI Cruises preview! This will show up as log level INFO!");

            return $pdf->stream();
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

    public function check_assign()
    {
        $arr_destco = Storage::disk('local')->get('cruisetuic_destinations.json');
        $arr_destco = json_decode($arr_destco);
        $arr_destco = array_column($arr_destco->RECORDS, 'countrytocode');

        $countries = Country::where('active', 1)->whereIn('code', $arr_destco)->get();
        $nationalities = Nationality::where('active', 1)->get();

        foreach ($countries as $country) {
            $nat_assigns = array_fill_keys($nationalities->pluck('id')->toArray(), false);
            $cruisetuics = Cruisetuic::where('active', 1)->where('countrytocode', $country->code)->get();
            foreach ($cruisetuics as $cruisetuic) {
                foreach($cruisetuic->nationalities as $nationality) {
                    $nat_assigns[$nationality->id] = true;
                }
            }
            $country->unassigned_nats = $nationalities->reject(function ($nationality, $key) use($nat_assigns) {
                return $nat_assigns[$nationality->id];
            });
            $country->unassigned_nats_string = implode(',', $country->unassigned_nats->pluck('code')->toArray());
        }

        return view('cruisetuics.check.assign', compact('countries'));
    }

}
