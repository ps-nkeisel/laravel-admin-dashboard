<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Http\Requests\TransitvisaFormRequest;
use App\Models\Transitvisa;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Transitvisainfo;
use App\Models\Language;
use App\Models\Contentadditional;
use App\Models\Useraction;
use App\Jobs\ProcessRedisStoreTransitvisa;
use Carbon\Carbon;
use Exception;
use Auth;
use PDF;

class TransitvisaController extends Controller
{

    /**
     * Display a listing of the transitvisas.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $nationalities = Nationality::where('active', 1)->get();

        return view('transitvisas.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new transitvisa.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $nationalities = Nationality::where('active', 1)->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $transitvisainfos = Transitvisainfo::orderBy('position', 'asc')->get();

        $required_contentgroups = Transitvisa::required_contentgroups()->get();
        $eta_contentgroups = Transitvisa::eta_contentgroups()->get();
        $footer_contentgroups = Transitvisa::footer_contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        return view('transitvisas.create', compact('nationalities', 'languages', 'transitvisainfos',
            'required_contentgroups', 'eta_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Store a new transitvisa in the storage.
     *
     * @param App\Http\Requests\TransitvisaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TransitvisaFormRequest $request)
    {
        try {

            $data = $request->getData();

            $transitvisa = Transitvisa::create($data);

            $country = Country::where('code', $transitvisa->countrytocode)->first();
            if ($country) {
                $transitvisa->country_id = $country->id;
            }

            $transitvisa->created_user = Auth::user()->id;
            $transitvisa->created_ip = $request->ip();
            $transitvisa->version = 1;
            $transitvisa->assignto = $transitvisa->id;
            $transitvisa->idversionbefore = 0;
            $transitvisa->idversionnext = 0;
            $transitvisa->save();

            $transitvisa->nationalities()->attach($request->nationality_ids);

            if ($transitvisa->required != 0) {
                $transitvisainfos = Transitvisainfo::orderBy('position', 'asc')->get();
                $transitvisainfoParams = $request->getParams(['transitvisainfos']);
                foreach ($transitvisainfoParams['transitvisainfos'] as $transitvisainfo_id) {
                    $transitvisa->transitvisainfos()->attach($transitvisainfo_id, [
                        'active' => true,
                        'created_user' => Auth::user()->id,
                        'created_ip' => $request->ip(),
                    ]);
                }
            }

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'req' && $transitvisa->required != 1) ||
                    ($contentadditionalsParam['languageSections'][$position] == 'eta' && $transitvisa->required != 2))
                {
                    continue;
                }

                $contentadditional = new Contentadditional;

                $contentadditional->position = $position;
                $contentadditional->section = $contentadditionalsParam['languageSections'][$position];
                $contentadditional->section_id = $contentadditionalsParam['languageSectionIds'][$position] ?? 0;
                $contentadditional->contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? 0;
                $contentadditional->reminder = $contentadditionalsParam['reminders'][$position] ? Carbon::parse($contentadditionalsParam['reminders'][$position]) : null;
                $contentadditional->created_user = Auth::user()->id;
                $contentadditional->created_ip = $request->ip();
                $contentadditional->active = 1;
                $contentadditional->archive = 0;

                $transitvisa->contentadditionals()->save($contentadditional);

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
            $useraction->assigntonew = $transitvisa->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 4;   // Transitvisa
            $useraction->comment = '';
            $useraction->code = $transitvisa->countrytocode;
            $useraction->version = $transitvisa->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            ProcessRedisStoreTransitvisa::dispatch([$transitvisa]);

            return redirect()->route('transitvisas.show', $transitvisa->id)
                ->with('success_message', 'Transitvisa was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified transitvisa.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $transitvisa = Transitvisa::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('transitvisas.show', compact('transitvisa', 'languages'));
    }

    /**
     * Show the form for editing the specified transitvisa.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $transitvisa = Transitvisa::findOrFail($id);
        $nationalities = Nationality::where('active', 1)->get();
        $transitvisainfos = Transitvisainfo::orderBy('position', 'asc')->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $contentadditionals = $transitvisa->contentadditionals;
        $required_contentadditionals = $transitvisa->required_contentadditionals;
        $eta_contentadditionals = $transitvisa->eta_contentadditionals;
        $footer_contentadditionals = $transitvisa->footer_contentadditionals;

        foreach ($transitvisa->nationalities as $nat) {
            $nationality = $nationalities->find($nat->id);
            if ($nationality) {
                $nationality->selected = true;
            }
        }

        foreach ($transitvisa->transitvisainfos as $tsvinfo) {
            $transitvisainfo = $transitvisainfos->find($tsvinfo->id);
            if ($transitvisainfo) {
                $transitvisainfo->active = $tsvinfo->pivot->active;
            }
        }

        $required_contentgroups = Transitvisa::required_contentgroups()->get();
        $eta_contentgroups = Transitvisa::eta_contentgroups()->get();
        $footer_contentgroups = Transitvisa::footer_contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        return view('transitvisas.edit', compact('transitvisa', 'nationalities', 'languages', 'transitvisainfos',
            'required_contentadditionals', 'eta_contentadditionals', 'footer_contentadditionals',
            'required_contentgroups', 'eta_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Update the specified transitvisa in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\TransitvisaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TransitvisaFormRequest $request)
    {
        try {

            $data = $request->getData();

            $old_transitvisa = Transitvisa::with([
                'country', 'nationalities', 'transitvisainfos', 'contentadditionals'
            ])->findOrFail($id);
            $transitvisa = $old_transitvisa->replicate();
            $transitvisa->push();
            $transitvisa->update($data);

            $country = Country::where('code', $transitvisa->countrytocode)->first();
            if ($country) {
                $transitvisa->country_id = $country->id;
            }
            $transitvisa->version ++;
            $transitvisa->created_user = Auth::user()->id;
            $transitvisa->created_ip = $request->ip();
            $transitvisa->assignto = $old_transitvisa->assignto;
            $transitvisa->idversionbefore = $old_transitvisa->id;
            $transitvisa->idversionnext = 0;
            $transitvisa->save();

            $old_transitvisa->active = 0;
            $old_transitvisa->archive = 1;
            $old_transitvisa->updated_user = Auth::user()->id;
            $old_transitvisa->updated_ip = $request->ip();
            $old_transitvisa->idversionnext = $transitvisa->id;
            $old_transitvisa->save();

            $transitvisa->nationalities()->attach($request->nationality_ids);

            if ($transitvisa->required != 0) {
                $transitvisainfos = Transitvisainfo::orderBy('position', 'asc')->get();
                $transitvisainfoParams = $request->getParams(['transitvisainfos']);
                foreach ($transitvisainfoParams['transitvisainfos'] as $transitvisainfo_id) {
                    $transitvisa->transitvisainfos()->attach($transitvisainfo_id, [
                        'active' => true,
                        'created_user' => Auth::user()->id,
                        'created_ip' => $request->ip(),
                    ]);
                }
            }

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if (($contentadditionalsParam['languageSections'][$position] == 'req' && $transitvisa->required != 1) ||
                    ($contentadditionalsParam['languageSections'][$position] == 'eta' && $transitvisa->required != 2))
                {
                    continue;
                }

                $contentadditional = new Contentadditional;

                $contentadditional->position = $position;
                $contentadditional->section = $contentadditionalsParam['languageSections'][$position];
                $contentadditional->section_id = $contentadditionalsParam['languageSectionIds'][$position] ?? 0;
                $contentadditional->contentgroup_id = $contentadditionalsParam['contentgroups'][$position] ?? 0;
                $contentadditional->reminder = $contentadditionalsParam['reminders'][$position] ? Carbon::parse($contentadditionalsParam['reminders'][$position]) : null;
                $contentadditional->created_user = Auth::user()->id;
                $contentadditional->created_ip = $request->ip();
                $contentadditional->active = 1;
                $contentadditional->archive = 0;

                $transitvisa->contentadditionals()->save($contentadditional);

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
            $useraction->assigntoold = $old_transitvisa->id;
            $useraction->assigntonew = $transitvisa->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 4;   // Transitvisa
            $useraction->comment = '';
            $useraction->code = $transitvisa->countrytocode;
            $useraction->version = $transitvisa->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            ProcessRedisStoreTransitvisa::dispatch([$transitvisa]);

            return redirect()->route('transitvisas.show', $transitvisa->id)
                ->with('success_message', 'Transitvisa was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified transitvisa from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $transitvisa = Transitvisa::findOrFail($id);
            $transitvisa->delete();

            return redirect()->route('transitvisas.index')
                ->with('success_message', 'Transitvisa was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function check_natassign($countrytocode)
    {
        $country = Country::where('code', $countrytocode)->firstOrFail();
        $transitvisas = Transitvisa::with('nationalities')->where('active', 1)->where('countrytocode', $countrytocode)->get();
        $nationalities = Nationality::where('active', 1)->get();

        $nationality_ids = $nationalities->pluck('id')->toArray();
        $nats_assign = array_fill_keys($nationality_ids, false);

        foreach ($transitvisas as $transitvisa) {
            foreach ($transitvisa->nationalities as $nat) {
                $nats_assign[$nat->id] = true;
            }
        }
        foreach ($nats_assign as $nat_id => $assign) {
            $nationalities->find($nat_id)->assign = $assign;
        }

        return view('transitvisas.check.natassign', compact('country', 'nationalities'));
    }

    public function check_assign()
    {
        $countries = Country::select('code')->where('active', 1)->orderBy('code', 'ASC')->get()->toArray();
        $nationalities = Nationality::select('code')->where('active', 1)->orderBy('code', 'ASC')->get()->toArray();

        // create matrix
        $checkArr = array();
        foreach($countries as $keyCountry => $valueCountry) {
            //dd($valueCountry['code']);
            foreach($nationalities as $keyNat => $valueNat) {
                if ($valueCountry['code'] != $valueNat['code']) {
                    $id = $valueCountry['code']."-".$valueNat['code'];
                    $countryCode = $valueCountry['code'];
                    $natCode = $valueNat['code'];
                    $checkArr[$countryCode][$natCode]['type'] = 0;
                }
            }
        }

        $checkArr1 = array();
        foreach($checkArr as $keyCheckArrCountry => $valueCheckArrCountry) {
            $codeCountry = $keyCheckArrCountry;
            foreach($valueCheckArrCountry as $keyCheckArrNat => $valueCheckArrNat) {
                $codeNat = $keyCheckArrNat;
                $codeCheck = $codeCountry."-".$codeNat;

                $transitvisaByCountry = DB::table('transitvisa')
                    ->select('transitvisa.id', 'transitvisa.countrytocode')
                    ->join('nationalitiables', 'transitvisa.id', '=', 'nationalitiables.nationalitiable_id')
                    ->join('nationalities', 'nationalitiables.nationality_id', 'nationalities.id')
                    ->where('transitvisa.countrytocode', '=', $codeCountry)
                    ->where('transitvisa.active', '=', 1)
                    ->where('nationalities.code', '=', $codeNat)
                    ->where('nationalitiables.nationalitiable_type', '=', 'App\Models\Transitvisa')
                    ->get()
                    ->toArray();


                if (count($transitvisaByCountry) == 0) {
                    $checkArr1[$codeCountry][$codeNat]['type'] = 0;
                    $checkArr1[$codeCountry][$codeNat]['info'] = "no data found for this nationality";
                } elseif (count($transitvisaByCountry) == 1)  {

                } else {
                    $checkArr1[$codeCountry][$codeNat]['type'] = 2;
                    $checkArr1[$codeCountry][$codeNat]['info'] = "more than one active record found for this nationality";
                }
            }
        }

        return view('transitvisas.check.assign', compact('checkArr1'));
    }

    public function preview(TransitvisaFormRequest $request)
    {
        try {
            $language = Language::where('code', 'en')->firstOrFail();
            $preview = Transitvisa::getPreview($request, $language);

            $pdf = PDF::loadView('layouts.pdf.report', $preview);

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

    public function report($id, Request $request)
    {
        try {
            $transitvisa = Transitvisa::findOrFail($id);
            $language = Language::where('code', $request->lang)->firstOrFail();

            $report = $transitvisa->getReport($language);

            $pdf = PDF::loadView('layouts.pdf.report', $report);

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

}
