<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Http\Requests\VisaFormRequest;
use App\Models\Visa;
use App\Models\Visadocument;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Language;
use App\Models\Contentadditional;
use App\Models\Useraction;
use App\Jobs\ProcessRedisStoreVisa;
use Carbon\Carbon;
use Exception;
use Auth;
use PDF;

class VisaController extends Controller
{
    /**
     * Display a listing of the visas.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $nationalities = Nationality::where('active', 1)->get();

        return view('visas.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new visa.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $nationalities = Nationality::where('active', 1)->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $visadocuments = Visadocument::orderBy('position', 'asc')->get();

        $required_contentgroups = Visa::required_contentgroups()->get();
        $orderonline_contentgroups = Visa::orderonline_contentgroups()->get();
        $orderforeign_contentgroups = Visa::orderforeign_contentgroups()->get();
        $orderonarrival_contentgroups = Visa::orderonarrival_contentgroups()->get();
        $beforedocument_contentgroups = Visa::beforedocument_contentgroups()->get();
        $afterdocument_contentgroups = Visa::afterdocument_contentgroups()->get();
        $entrybyland_contentgroups = Visa::entrybyland_contentgroups()->get();
        $entrybysea_contentgroups = Visa::entrybysea_contentgroups()->get();
        $afterentrybysea_contentgroups = Visa::afterentrybysea_contentgroups()->get();
        $footer_contentgroups = Visa::footer_contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        return view('visas.create', compact('nationalities', 'languages', 'visadocuments',
            'required_contentgroups', 'orderonline_contentgroups', 'orderforeign_contentgroups', 'orderonarrival_contentgroups', 'beforedocument_contentgroups',
            'afterdocument_contentgroups', 'entrybyland_contentgroups', 'entrybysea_contentgroups', 'afterentrybysea_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Store a new visa in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(VisaFormRequest $request)
    {
        try {
            $data = $request->getData();

            $visa = Visa::create($data);

            $country = Country::where('code', $visa->countrytocode)->first();
            if ($country) {
                $visa->country_id = $country->id;
            }

            $visa->created_user = Auth::user()->id;
            $visa->created_ip = $request->ip();
            $visa->version = 1;
            $visa->assignto = $visa->id;
            $visa->idversionbefore = 0;
            $visa->idversionnext = 0;
            $visa->save();

            $visa->nationalities()->attach($request->nationality_ids);

            $visadocuments = Visadocument::orderBy('position', 'asc')->get();
            $visadocParams = $request->getParams(['visadocuments']);
            foreach ($visadocParams['visadocuments'] as $visadocument_id) {
                $visa->visadocuments()->attach($visadocument_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                ]);
            }

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if ($data['require1'] != 1 &&
                    ($contentadditionalsParam['languageSections'][$position] == 'orderon' ||
                    $contentadditionalsParam['languageSections'][$position] == 'orderrep' ||
                    $contentadditionalsParam['languageSections'][$position] == 'orderarr')) {
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

                $visa->contentadditionals()->save($contentadditional);

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
            $useraction->assigntonew = $visa->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 12;   // Visa
            $useraction->comment = '';
            $useraction->code = $visa->countrytocode;
            $useraction->version = $visa->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            ProcessRedisStoreVisa::dispatch([$visa]);

            return redirect()->route('visas.show', $visa->id)
                ->with('success_message', 'Visa was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified visa.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $visa = Visa::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('visas.show', compact('visa', 'languages'));
    }

    /**
     * Show the form for editing the specified visa.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $visa = Visa::findOrFail($id);
        $nationalities = Nationality::where('active', 1)->get();
        $visadocuments = Visadocument::orderBy('position', 'asc')->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $contentadditionals = $visa->contentadditionals;
        $required_contentadditionals = $visa->required_contentadditionals;
        $orderonline_contentadditionals = $visa->orderonline_contentadditionals;
        $orderforeign_contentadditionals = $visa->orderforeign_contentadditionals;
        $orderonarrival_contentadditionals = $visa->orderonarrival_contentadditionals;
        $beforedocument_contentadditionals = $visa->beforedocument_contentadditionals;
        $afterdocument_contentadditionals = $visa->afterdocument_contentadditionals;
        $entrybyland_contentadditionals = $visa->entrybyland_contentadditionals;
        $entrybysea_contentadditionals = $visa->entrybysea_contentadditionals;
        $afterentrybysea_contentadditionals = $visa->afterentrybysea_contentadditionals;
        $footer_contentadditionals = $visa->footer_contentadditionals;

        foreach ($visa->nationalities as $nat) {
            $nationality = $nationalities->find($nat->id);
            if ($nationality) {
                $nationality->selected = true;
            }
        }

        foreach ($visa->visadocuments as $visadoc) {
            $visadocument = $visadocuments->find($visadoc->id);
            if ($visadocument) {
                $visadocument->active = $visadoc->pivot->active;
            }
        }

        $required_contentgroups = Visa::required_contentgroups()->get();
        $orderonline_contentgroups = Visa::orderonline_contentgroups()->get();
        $orderforeign_contentgroups = Visa::orderforeign_contentgroups()->get();
        $orderonarrival_contentgroups = Visa::orderonarrival_contentgroups()->get();
        $beforedocument_contentgroups = Visa::beforedocument_contentgroups()->get();
        $afterdocument_contentgroups = Visa::afterdocument_contentgroups()->get();
        $entrybyland_contentgroups = Visa::entrybyland_contentgroups()->get();
        $entrybysea_contentgroups = Visa::entrybysea_contentgroups()->get();
        $afterentrybysea_contentgroups = Visa::afterentrybysea_contentgroups()->get();
        $footer_contentgroups = Visa::footer_contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        return view('visas.edit', compact('visa', 'nationalities', 'visadocuments', 'languages',
            'required_contentadditionals', 'orderonline_contentadditionals', 'orderforeign_contentadditionals', 'orderonarrival_contentadditionals', 'beforedocument_contentadditionals', 'afterdocument_contentadditionals', 'entrybyland_contentadditionals', 'entrybysea_contentadditionals', 'afterentrybysea_contentadditionals', 'footer_contentadditionals',
            'required_contentgroups', 'orderonline_contentgroups', 'orderforeign_contentgroups', 'orderonarrival_contentgroups', 'beforedocument_contentgroups', 'afterdocument_contentgroups', 'entrybyland_contentgroups', 'entrybysea_contentgroups', 'afterentrybysea_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Update the specified visa in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, VisaFormRequest $request)
    {
        try {

            $data = $request->getData();

            $old_visa = Visa::with([
                'nationalities', 'visadocuments', 'contentadditionals'
            ])->findOrFail($id);
            $visa = $old_visa->replicate();
            $visa->uuid = null;
            $visa->push();
            $visa->update($data);

            $country = Country::where('code', $visa->countrytocode)->first();
            if ($country) {
                $visa->country_id = $country->id;
            }
            $visa->version ++;
            $visa->created_user = Auth::user()->id;
            $visa->created_ip = $request->ip();
            $visa->assignto = $old_visa->assignto;
            $visa->idversionbefore = $old_visa->id;
            $visa->idversionnext = 0;
            $visa->save();

            $old_visa->active = 0;
            $old_visa->archive = 1;
            $old_visa->updated_user = Auth::user()->id;
            $old_visa->updated_ip = $request->ip();
            $old_visa->idversionnext = $visa->id;
            $old_visa->contentadditionals()->update([
                'active' => 0,
                'archive' => 1
            ]);
            $old_visa->save();

            $visa->nationalities()->attach($request->nationality_ids);

            $visadocuments = Visadocument::orderBy('position', 'asc')->get();
            $visadocParams = $request->getParams(['visadocuments']);
            foreach ($visadocParams['visadocuments'] as $visadocument_id) {
                $visa->visadocuments()->attach($visadocument_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                ]);
            }

            $contentadditionalsParam = $request->getParams(['languageHeadlines', 'languageContents', 'languageSections', 'languageSectionIds', 'languageMains', 'contentgroups', 'reminders', 'translatedfroms']);
            foreach ($contentadditionalsParam['languageHeadlines'] as $position => $headlines) {
                if ($data['require1'] != 1 &&
                    ($contentadditionalsParam['languageSections'][$position] == 'orderon' ||
                    $contentadditionalsParam['languageSections'][$position] == 'orderrep' ||
                    $contentadditionalsParam['languageSections'][$position] == 'orderarr')) {
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

                $visa->contentadditionals()->save($contentadditional);

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
            $useraction->assigntoold = $old_visa->id;
            $useraction->assigntonew = $visa->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 12;   // Visa
            $useraction->comment = '';
            $useraction->code = $visa->countrytocode;
            $useraction->version = $visa->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            ProcessRedisStoreVisa::dispatch([$visa]);

            return redirect()->route('visas.show', $visa->id)
                ->with('success_message', 'Visa was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified visa from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $visa = Visa::findOrFail($id);
            $visa->delete();

            return redirect()->route('visas.index')
                ->with('success_message', 'Visa was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function check_natassign($countrytocode)
    {
        $country = Country::where('code', $countrytocode)->firstOrFail();
        $visas = Visa::with('nationalities')->where('active', 1)->where('countrytocode', $countrytocode)->get();
        $nationalities = Nationality::where('active', 1)->get();

        $nationality_ids = $nationalities->pluck('id')->toArray();
        $nats_assign = array_fill_keys($nationality_ids, false);

        foreach ($visas as $visa) {
            foreach ($visa->nationalities as $nat) {
                $nats_assign[$nat->id] = true;
            }
        }
        foreach ($nats_assign as $nat_id => $assign) {
            $nationalities->find($nat_id)->assign = $assign;
        }

        return view('visas.check.natassign', compact('country', 'nationalities'));
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

                $visaByCountry = DB::table('visas')
                    ->select('visas.id', 'visas.countrytocode')
                    ->join('nationalitiables', 'visas.id', '=', 'nationalitiables.nationalitiable_id')
                    ->join('nationalities', 'nationalitiables.nationality_id', 'nationalities.id')
                    ->where('visas.countrytocode', '=', $codeCountry)
                    ->where('visas.active', '=', 1)
                    ->where('nationalities.code', '=', $codeNat)
                    ->where('nationalitiables.nationalitiable_type', '=', 'App\Models\Visa')
                    ->get()
                    ->toArray();

                if (count($visaByCountry) == 0) {
                    $checkArr1[$codeCountry][$codeNat]['type'] = 0;
                    $checkArr1[$codeCountry][$codeNat]['info'] = "no data found for this nationality";
                } elseif (count($visaByCountry) == 1)  {

                } else {
                    $checkArr1[$codeCountry][$codeNat]['type'] = 2;
                    $checkArr1[$codeCountry][$codeNat]['info'] = "more than one active record found for this nationality";
                }
            }
        }

        return view('visas.check.assign', compact('checkArr1'));
    }

    public function check_require1()
    {
        $nationalities = Nationality::where('active', 1)->get();

        return view('visas.check.require1', compact('nationalities'));
    }

    public function preview(VisaFormRequest $request)
    {
        try {
            $language = Language::where('code', 'en')->firstOrFail();
            $preview = Visa::getPreview($request, $language);

            $preview['content'] = str_replace('<i class="fas fa-2x fa-check text-success"></i>',
                '<div class="text-success" style="font-family: DejaVu Sans, sans-serif; font-size: 40px;">&#10003;</div>',
                $preview['content']
            );
            $preview['content'] = str_replace('<i class="fas fa-2x fa-times text-danger"></i>',
                '<div class="text-danger" style="font-family: DejaVu Sans, sans-serif; font-size: 40px;">&#10005;</div>',
                $preview['content']
            );

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
            $visa = Visa::findOrFail($id);
            $language = Language::where('code', $request->lang)->firstOrFail();

            $report = $visa->getReport($language);

            $report['content'] = str_replace('<i class="fas fa-2x fa-check text-success"></i>',
                '<div class="text-success" style="font-family: DejaVu Sans, sans-serif; font-size: 40px;">&#10003;</div>',
                $report['content']
            );
            $report['content'] = str_replace('<i class="fas fa-2x fa-times text-danger"></i>',
                '<div class="text-danger" style="font-family: DejaVu Sans, sans-serif; font-size: 40px;">&#10005;</div>',
                $report['content']
            );

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
