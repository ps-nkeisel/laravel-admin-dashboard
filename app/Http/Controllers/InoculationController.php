<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InoculationFormRequest;
use App\Models\Inoculation;
use App\Models\Immunisation;
use App\Models\Inooptionchild;
use App\Models\Inooptionpregnant;
use App\Models\Yellowfever;
use App\Models\Inoculationspecific;
use App\Models\Language;
use App\Models\Contentadditional;
use App\Models\Inoresult;
use App\Models\Country;
use App\Models\Useraction;
use App\Jobs\ProcessRedisStoreInoculation;
use Carbon\Carbon;
use Exception;
use Auth;
use PDF;

class InoculationController extends Controller
{
    /**
     * Display a listing of the inoculations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('inoculations.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $requirement_immunisations = Immunisation::orderBy('position', 'asc')->get();
        $recommendation_immunisations = Immunisation::orderBy('position', 'asc')->get();
        $optionpregnants = Inooptionpregnant::orderBy('position', 'asc')->get();
        $optionchildren = Inooptionchild::orderBy('position', 'asc')->get();
        $yellowfevers = Yellowfever::orderBy('position', 'asc')->get();
        $inoculationspecifics = Inoculationspecific::orderBy('position', 'asc')->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $pregnant_contentgroups = Inoculation::pregnant_contentgroups()->get();
        $child_contentgroups = Inoculation::child_contentgroups()->get();
        $yellowfever_contentgroups = Inoculation::yellowfever_contentgroups()->get();
        $specific_contentgroups = Inoculation::specific_contentgroups()->get();
        $footer_contentgroups = Inoculation::footer_contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        return view('inoculations.create', compact('requirement_immunisations', 'recommendation_immunisations', 'optionpregnants', 'optionchildren', 'yellowfevers', 'inoculationspecifics', 'languages',
            'pregnant_contentgroups', 'child_contentgroups', 'yellowfever_contentgroups', 'specific_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Store a new inoculation in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(InoculationFormRequest $request)
    {
        try {

            $data = $request->getData();

            $inoculation = Inoculation::create($data);

            $country = Country::where('code', $inoculation->countrytocode)->first();
            if ($country) {
                $inoculation->country_id = $country->id;
            }

            $inoculation->created_user = Auth::user()->id;
            $inoculation->created_ip = $request->ip();
            $inoculation->version = 1;
            $inoculation->assignto = $inoculation->id;
            $inoculation->idversionbefore = 0;
            $inoculation->idversionnext = 0;
            $inoculation->save();

            $reqImmunParams = $request->getParams(['requirement_immunisations', 'requirement_longtermstays', 'requirement_specialexposures']);
            foreach ($reqImmunParams['requirement_immunisations'] as $immunisation_id) {
                $inoculation->requirement_immunisations()->attach($immunisation_id, [
                    'active' => true,
                    'longtermstay' => array_search($immunisation_id, $reqImmunParams['requirement_longtermstays']) !== false ? true : false,
                    'specialexposure' => array_search($immunisation_id, $reqImmunParams['requirement_specialexposures']) !== false ? true : false,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $recImmunParams = $request->getParams(['recommendation_immunisations', 'recommendation_longtermstays', 'recommendation_specialexposures']);
            foreach ($recImmunParams['recommendation_immunisations'] as $immunisation_id) {
                $inoculation->recommendation_immunisations()->attach($immunisation_id, [
                    'active' => true,
                    'longtermstay' => array_search($immunisation_id, $recImmunParams['recommendation_longtermstays']) !== false ? true : false,
                    'specialexposure' => array_search($immunisation_id, $recImmunParams['recommendation_specialexposures']) !== false ? true : false,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $optpregParams = $request->getParams(['optionpregnants']);
            foreach ($optpregParams['optionpregnants'] as $optionpregnant_id) {
                $inoculation->optionpregnants()->attach($optionpregnant_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $optchildParams = $request->getParams(['optionchildren']);
            foreach ($optchildParams['optionchildren'] as $optionchild_id) {
                $inoculation->optionchildren()->attach($optionchild_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $specParams = $request->getParams(['inoculationspecifics']);
            foreach ($specParams['inoculationspecifics'] as $inoculationspecific_id) {
                $inoculation->inoculationspecifics()->attach($inoculationspecific_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
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

                $inoculation->contentadditionals()->save($contentadditional);

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

            // $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
            // foreach ($languages as $language) {
            //     $inoresult = new Inoresult;
            //     $inoresult->assignto = $inoculation->id;
            //     $inoresult->version = $inoculation->version;

            //     $report = $inoculation->getReport($language->code);
            //     $inoresult->content1 = $report['content'];

            //     $inoresult->lang = $language->id;
            //     $inoresult->version = 1;
            //     $inoresult->created_user = Auth::user()->id;
            //     $inoresult->created_ip = $request->ip();
            //     $inoresult->save();
            // }

            $useraction = new Useraction;
            $useraction->assigntonew = $inoculation->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 17;   // Inoculation
            $useraction->comment = '';
            $useraction->code = $inoculation->countrytocode;
            $useraction->version = $inoculation->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            ProcessRedisStoreInoculation::dispatch([$inoculation]);

            return redirect()->route('inoculations.show', $inoculation->id)
                ->with('success_message', 'Inoculation was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $inoculation = Inoculation::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('inoculations.show', compact('inoculation', 'languages'));
    }

    /**
     * Show the form for editing the specified
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $inoculation = Inoculation::findOrFail($id);

        $requirement_immunisations = Immunisation::orderBy('position', 'asc')->get();
        $recommendation_immunisations = Immunisation::orderBy('position', 'asc')->get();
        $optionpregnants = Inooptionpregnant::orderBy('position', 'asc')->get();
        $optionchildren = Inooptionchild::orderBy('position', 'asc')->get();
        $yellowfevers = Yellowfever::orderBy('position', 'asc')->get();
        $inoculationspecifics = Inoculationspecific::orderBy('position', 'asc')->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $pregnant_contentadditionals = $inoculation->pregnant_contentadditionals;
        $child_contentadditionals = $inoculation->child_contentadditionals;
        $yellowfever_contentadditionals = $inoculation->yellowfever_contentadditionals;
        $specific_contentadditionals = $inoculation->specific_contentadditionals;
        $footer_contentadditionals = $inoculation->footer_contentadditionals;

        $pregnant_contentgroups = Inoculation::pregnant_contentgroups()->get();
        $child_contentgroups = Inoculation::child_contentgroups()->get();
        $yellowfever_contentgroups = Inoculation::yellowfever_contentgroups()->get();
        $specific_contentgroups = Inoculation::specific_contentgroups()->get();
        $footer_contentgroups = Inoculation::footer_contentgroups()->get();

        foreach ($inoculation->requirement_immunisations as $immunisation) {
            $requirement_immunisation = $requirement_immunisations->find($immunisation->id);
            if ($requirement_immunisation) {
                $requirement_immunisation->active = $immunisation->pivot->active;
                $requirement_immunisation->longtermstay = $immunisation->pivot->longtermstay;
                $requirement_immunisation->specialexposure = $immunisation->pivot->specialexposure;
            }
        }
        foreach ($inoculation->recommendation_immunisations as $immunisation) {
            $recommendation_immunisation = $recommendation_immunisations->find($immunisation->id);
            if ($recommendation_immunisation) {
                $recommendation_immunisation->active = $immunisation->pivot->active;
                $recommendation_immunisation->longtermstay = $immunisation->pivot->longtermstay;
                $recommendation_immunisation->specialexposure = $immunisation->pivot->specialexposure;
            }
        }
        foreach ($inoculation->optionpregnants as $optpregnant) {
            $optionpregnant = $optionpregnants->find($optpregnant->id);
            if ($optionpregnant) {
                $optionpregnant->active = $optpregnant->pivot->active;
            }
        }
        foreach ($inoculation->optionchildren as $optchild) {
            $optionchild = $optionchildren->find($optchild->id);
            if ($optionchild) {
                $optionchild->active = $optchild->pivot->active;
            }
        }
        $yellowfever = $yellowfevers->find($inoculation->yellowfever_id);
        if ($yellowfever) {
            $yellowfever->active = true;
            $yellowfever->ggmonth = $inoculation->ggmonth;
            $yellowfever->transitingeneral = $inoculation->transitingeneral;
            $yellowfever->transittime12hours = $inoculation->transittime12hours;
        }
        foreach ($inoculation->inoculationspecifics as $specific) {
            $inoculationspecific = $inoculationspecifics->find($specific->id);
            if ($inoculationspecific) {
                $inoculationspecific->active = $specific->pivot->active;
            }
        }

        $translation_status = getTranslationStatusArray();

        return view('inoculations.edit', compact('inoculation', 'languages',
            'requirement_immunisations', 'recommendation_immunisations', 'optionpregnants', 'optionchildren', 'yellowfevers', 'inoculationspecifics',
            'pregnant_contentadditionals', 'child_contentadditionals', 'yellowfever_contentadditionals', 'specific_contentadditionals', 'footer_contentadditionals',
            'pregnant_contentgroups', 'child_contentgroups', 'yellowfever_contentgroups', 'specific_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Update the specified inoculation in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, InoculationFormRequest $request)
    {
        try {

            $data = $request->getData();

            $old_inoculation = Inoculation::with([
                'requirement_immunisations', 'recommendation_immunisations', 'optionpregnants', 'optionchildren', 'inoculationspecifics', 'contentadditionals', 'contentadditionals.languages'
            ])->findOrFail($id);
            $inoculation = $old_inoculation->replicate();
            $inoculation->uuid = null;
            $inoculation->push();
            $inoculation->update($data);

            $country = Country::where('code', $inoculation->countrytocode)->first();
            if ($country) {
                $inoculation->country_id = $country->id;
            }
            $inoculation->version ++;
            $inoculation->created_user = Auth::user()->id;
            $inoculation->created_ip = $request->ip();
            $inoculation->assignto = $old_inoculation->assignto;
            $inoculation->idversionbefore = $old_inoculation->id;
            $inoculation->idversionnext = 0;
            $inoculation->save();

            $old_inoculation->active = 0;
            $old_inoculation->archive = 1;
            $old_inoculation->updated_user = Auth::user()->id;
            $old_inoculation->updated_ip = $request->ip();
            $old_inoculation->idversionnext = $inoculation->id;
            $old_inoculation->contentadditionals()->update([
                'active' => 0,
                'archive' => 1
            ]);
            $old_inoculation->save();

            $reqImmunParams = $request->getParams(['requirement_immunisations', 'requirement_longtermstays', 'requirement_specialexposures']);
            foreach ($reqImmunParams['requirement_immunisations'] as $immunisation_id) {
                $inoculation->requirement_immunisations()->attach($immunisation_id, [
                    'active' => true,
                    'longtermstay' => array_search($immunisation_id, $reqImmunParams['requirement_longtermstays']) !== false ? true : false,
                    'specialexposure' => array_search($immunisation_id, $reqImmunParams['requirement_specialexposures']) !== false ? true : false,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $recImmunParams = $request->getParams(['recommendation_immunisations', 'recommendation_longtermstays', 'recommendation_specialexposures']);
            foreach ($recImmunParams['recommendation_immunisations'] as $immunisation_id) {
                $inoculation->recommendation_immunisations()->attach($immunisation_id, [
                    'active' => true,
                    'longtermstay' => array_search($immunisation_id, $recImmunParams['recommendation_longtermstays']) !== false ? true : false,
                    'specialexposure' => array_search($immunisation_id, $recImmunParams['recommendation_specialexposures']) !== false ? true : false,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $optpregParams = $request->getParams(['optionpregnants']);
            foreach ($optpregParams['optionpregnants'] as $optionpregnant_id) {
                $inoculation->optionpregnants()->attach($optionpregnant_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $optchildParams = $request->getParams(['optionchildren']);
            foreach ($optchildParams['optionchildren'] as $optionchild_id) {
                $inoculation->optionchildren()->attach($optionchild_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $specParams = $request->getParams(['inoculationspecifics']);
            foreach ($specParams['inoculationspecifics'] as $inoculationspecific_id) {
                $inoculation->inoculationspecifics()->attach($inoculationspecific_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                    'version' => 1,
                ]);
            }

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
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

                $inoculation->contentadditionals()->save($contentadditional);

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

            // $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
            // foreach ($languages as $language) {
            //     $inoresult = new Inoresult;
            //     $inoresult->assignto = $inoculation->id;
            //     $inoresult->version = $inoculation->version;

            //     $report = $inoculation->getReport($language->code);
            //     $inoresult->content1 = $report['content'];

            //     $inoresult->lang = $language->id;
            //     $inoresult->version = $inoculation->version;
            //     $inoresult->created_user = Auth::user()->id;
            //     $inoresult->created_ip = $request->ip();
            //     $inoresult->save();
            // }

            $useraction = new Useraction;
            $useraction->assigntoold = $old_inoculation->id;
            $useraction->assigntonew = $inoculation->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 17;   // Inoculation
            $useraction->comment = '';
            $useraction->code = $inoculation->countrytocode;
            $useraction->version = $inoculation->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            ProcessRedisStoreInoculation::dispatch([$inoculation]);

            return redirect()->route('inoculations.show', $inoculation->id)
                ->with('success_message', 'Inoculation was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified inoculation from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $inoculation = Inoculation::findOrFail($id);
            $inoculation->delete();

            return redirect()->route('inoculations.index')
                ->with('success_message', 'Inoculation was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function check_assign()
    {
        $countries = Country::where('active', 1)->get();
        $inoculations = Inoculation::where('active', 1)->get();

        $unassigned_countries = $countries->reject(function ($country, $key) use($inoculations) {
            return $inoculations->where('countrytocode', $country->code)->count() > 0 ? true : false;
        });

        return view('inoculations.check.assign', compact('unassigned_countries'));
    }


    public function preview(InoculationFormRequest $request)
    {
        try {
            $language = Language::where('code', 'en')->firstOrFail();
            $preview = Inoculation::getPreview($request, $language);

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
            $inoculation = Inoculation::findOrFail($id);
            $language = Language::where('code', $request->lang)->firstOrFail();

            $report = $inoculation->getReport($language);

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
