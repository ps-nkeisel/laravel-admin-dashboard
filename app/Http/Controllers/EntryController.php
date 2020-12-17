<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Http\Requests\EntryFormRequest;
use App\Models\Entry;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Entryidentitydocument;
use App\Models\Entrypassport;
use App\Models\Entryaddinfo;
use App\Models\Entryminor;
use App\Models\Language;
use App\Models\Contentadditional;
use App\Models\Useraction;
use App\Models\Notification;
use App\Events\NotifyToAll;
use App\Jobs\ProcessRedisStoreEntry;
use Carbon\Carbon;
use Exception;
use Auth;
use PDF;

class EntryController extends Controller
{
    /**
     * Display a listing of the entries.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $nationalities = Nationality::where('active', 1)->get();

        return view('entries.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new entry.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $nationalities = Nationality::where('active', 1)->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $entryidentitydocuments = Entryidentitydocument::orderBy('position', 'asc')->get();
        $entrypassports = Entrypassport::orderBy('position', 'asc')->get();
        $entryaddinfos = Entryaddinfo::orderBy('position', 'asc')->get();
        $entryminors = Entryminor::orderBy('position', 'asc')->get();

        $passport_contentgroups = Entry::passport_contentgroups()->get();
        $afterpassport_contentgroups = Entry::afterpassport_contentgroups()->get();
        $addinfo_contentgroups = Entry::addinfo_contentgroups()->get();
        $afteraddinfo_contentgroups = Entry::afteraddinfo_contentgroups()->get();
        $minor_contentgroups = Entry::minor_contentgroups()->get();
        $footer_contentgroups = Entry::footer_contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        return view('entries.create', compact('nationalities', 'languages', 'entryidentitydocuments', 'entrypassports', 'entryaddinfos', 'entryminors',
            'passport_contentgroups', 'afterpassport_contentgroups', 'addinfo_contentgroups', 'afteraddinfo_contentgroups', 'minor_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Store a new entry in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EntryFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entry = Entry::create($data);

            $country = Country::where('code', $entry->countrytocode)->first();
            if ($country) {
                $entry->country_id = $country->id;
            }

            $entry->created_user = Auth::user()->id;
            $entry->created_ip = $request->ip();
            $entry->version = 1;
            $entry->assignto = $entry->id;
            $entry->idversionbefore = 0;
            $entry->idversionnext = 0;
            $entry->save();

            $entry->nationalities()->attach($request->nationality_ids);

            $entrypassportParams = $request->getParams(['entrypassports', 'entrypassport_monthsvaliditys', 'passport_periods']);
            foreach ($entrypassportParams['entrypassports'] as $entrypassport_id) {
                $entry->entrypassports()->attach($entrypassport_id, [
                    'active' => true,
                    'months_validity' => $entrypassportParams['entrypassport_monthsvaliditys'][$entrypassport_id] ?? 0,
                    'period' => $entrypassportParams['passport_periods'][$entrypassport_id] ?? 0,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                ]);
            }

            $entryaddinfos = Entryaddinfo::orderBy('position', 'asc')->get();
            $entryaddinfoParams = $request->getParams(['entryaddinfos']);
            foreach ($entryaddinfoParams['entryaddinfos'] as $entryaddinfo_id) {
                $entry->entryaddinfos()->attach($entryaddinfo_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                ]);
            }

            $entryminors = Entryminor::orderBy('position', 'asc')->get();
            $entryminorParams = $request->getParams(['entryminors']);
            foreach ($entryminorParams['entryminors'] as $entryminor_id) {
                $entry->entryminors()->attach($entryminor_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
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

                $entry->contentadditionals()->save($contentadditional);

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
            $useraction->assigntonew = $entry->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 2;   // Entry
            $useraction->comment = '';
            $useraction->code = $entry->countrytocode;
            $useraction->version = $entry->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            ProcessRedisStoreEntry::dispatch([$entry]);

            return redirect()->route('entries.show', $entry->id)
                ->with('success_message', 'Entry was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified entry.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $entry = Entry::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        foreach ($entry->entrypassports as $entrypassport) {
            $entrypassport->contentadditionals = $entry->passport_contentadditionals->where('section_id', $entrypassport->id);
        }
        foreach ($entry->entryaddinfos as $entryaddinfo) {
            $entryaddinfo->contentadditionals = $entry->addinfo_contentadditionals->where('section_id', $entryaddinfo->id);
        }

        return view('entries.show', compact('entry', 'languages'));
    }

    /**
     * Show the form for editing the specified entry.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $entry = Entry::findOrFail($id);
        $nationalities = Nationality::where('active', 1)->get();
        $entryidentitydocuments = Entryidentitydocument::orderBy('position', 'asc')->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $entrypassports = Entrypassport::orderBy('position', 'asc')->get();
        $entryaddinfos = Entryaddinfo::orderBy('position', 'asc')->get();
        $entryminors = Entryminor::orderBy('position', 'asc')->get();
        $afterpassport_contentadditionals = $entry->afterpassport_contentadditionals;
        $afteraddinfo_contentadditionals = $entry->afteraddinfo_contentadditionals;
        $minor_contentadditionals = $entry->minor_contentadditionals;
        $footer_contentadditionals = $entry->footer_contentadditionals;

        foreach ($entry->nationalities as $nat) {
            $nationality = $nationalities->find($nat->id);
            if ($nationality) {
                $nationality->selected = true;
            }
        }
        foreach ($entry->entryidentitydocuments as $entrydoc) {
            $entryidentitydocument = $entryidentitydocuments->find($entrydoc->id);
            if ($entryidentitydocument) {
                $entryidentitydocument->active = $entrydoc->pivot->active;
            }
        }
        foreach ($entry->entrypassports as $entrypas) {
            $entrypassport = $entrypassports->find($entrypas->id);
            if ($entrypassport) {
                $entrypassport->active = $entrypas->pivot->active;
                $entrypassport->months_validity = $entrypas->pivot->months_validity;
                $entrypassport->period = $entrypas->pivot->period;
                $entrypassport->contentadditionals = $entry->passport_contentadditionals->where('section_id', $entrypassport->id);
            }
        }
        foreach ($entry->entryaddinfos as $entryadd) {
            $entryaddinfo = $entryaddinfos->find($entryadd->id);
            if ($entryaddinfo) {
                $entryaddinfo->active = $entryadd->pivot->active;
                $entryaddinfo->contentadditionals = $entry->addinfo_contentadditionals->where('section_id', $entryaddinfo->id);
            }
        }
        foreach ($entry->entryminors as $entrymin) {
            $entryminor = $entryminors->find($entrymin->id);
            if ($entryminor) {
                $entryminor->active = $entrymin->pivot->active;
            }
        }

        $passport_contentgroups = Entry::passport_contentgroups()->get();
        $afterpassport_contentgroups = Entry::afterpassport_contentgroups()->get();
        $addinfo_contentgroups = Entry::addinfo_contentgroups()->get();
        $afteraddinfo_contentgroups = Entry::afteraddinfo_contentgroups()->get();
        $minor_contentgroups = Entry::minor_contentgroups()->get();
        $footer_contentgroups = Entry::footer_contentgroups()->get();

        $translation_status = getTranslationStatusArray();

        return view('entries.edit', compact('entry', 'nationalities', 'languages', 'entryidentitydocuments',
            'entrypassports', 'entryaddinfos', 'entryminors',
            'afterpassport_contentadditionals', 'afteraddinfo_contentadditionals', 'minor_contentadditionals', 'footer_contentadditionals',
            'passport_contentgroups', 'afterpassport_contentgroups', 'addinfo_contentgroups', 'afteraddinfo_contentgroups', 'minor_contentgroups', 'footer_contentgroups',
            'translation_status'));
    }

    /**
     * Update the specified entry in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EntryFormRequest $request)
    {
        try {

            $data = $request->getData();

            $old_entry = Entry::with([
                'country', 'nationalities', 'contentadditionals'
            ])->findOrFail($id);
            $entry = $old_entry->replicate();
            $entry->uuid = null;
            $entry->push();
            $entry->update($data);

            $country = Country::where('code', $entry->countrytocode)->first();
            if ($country) {
                $entry->country_id = $country->id;
            }
            $entry->version ++;
            $entry->created_user = Auth::user()->id;
            $entry->created_ip = $request->ip();
            $entry->assignto = $old_entry->assignto;
            $entry->idversionbefore = $old_entry->id;
            $entry->idversionnext = 0;
            $entry->save();

            $old_entry->active = 0;
            $old_entry->archive = 1;
            $old_entry->updated_user = Auth::user()->id;
            $old_entry->updated_ip = $request->ip();
            $old_entry->idversionnext = $entry->id;
            $old_entry->contentadditionals()->update([
                'active' => 0,
                'archive' => 1
            ]);
            $old_entry->save();

            $entry->nationalities()->attach($request->nationality_ids);

            $entrypassportParams = $request->getParams(['entrypassports', 'entrypassport_monthsvaliditys', 'passport_periods']);
            foreach ($entrypassportParams['entrypassports'] as $entrypassport_id) {
                $entry->entrypassports()->attach($entrypassport_id, [
                    'active' => true,
                    'months_validity' => $entrypassportParams['entrypassport_monthsvaliditys'][$entrypassport_id] ?? 0,
                    'period' => $entrypassportParams['passport_periods'][$entrypassport_id] ?? 0,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                ]);
            }

            $entryaddinfos = Entryaddinfo::orderBy('position', 'asc')->get();
            $entryaddinfoParams = $request->getParams(['entryaddinfos']);
            foreach ($entryaddinfoParams['entryaddinfos'] as $entryaddinfo_id) {
                $entry->entryaddinfos()->attach($entryaddinfo_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
                ]);
            }

            $entryminors = Entryminor::orderBy('position', 'asc')->get();
            $entryminorParams = $request->getParams(['entryminors']);
            foreach ($entryminorParams['entryminors'] as $entryminor_id) {
                $entry->entryminors()->attach($entryminor_id, [
                    'active' => true,
                    'created_user' => Auth::user()->id,
                    'created_ip' => $request->ip(),
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

                $entry->contentadditionals()->save($contentadditional);

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
            $useraction->assigntoold = $old_entry->id;
            $useraction->assigntonew = $entry->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 2;   // Entry
            $useraction->comment = '';
            $useraction->code = $entry->countrytocode;
            $useraction->version = $entry->version;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            // $notification = Notification::create([
            //     'user_id' => 0,
            //     'type' => 'info',
            //     'message' => 'Entry has been updated'
            // ]);

            // broadcast(new NotifyToAll($notification));

            ProcessRedisStoreEntry::dispatch([$entry]);

            return redirect()->route('entries.show', $entry->id)
                ->with('success_message', 'Entry was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified entry from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $entry = Entry::findOrFail($id);
            $entry->delete();

            return redirect()->route('entries.index')
                ->with('success_message', 'Entry was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function check_passassign()
    {
        $nationalities = Nationality::where('active', 1)->get();
        $entrypassports = Entrypassport::orderBy('position', 'asc')->get();

        return view('entries.check.passassign', compact('nationalities', 'entrypassports'));
    }

    public function check_natassign($countrytocode)
    {
        $country = Country::where('code', $countrytocode)->firstOrFail();
        $entries = Entry::with('nationalities')->where('active', 1)->where('countrytocode', $countrytocode)->get();
        $nationalities = Nationality::where('active', 1)->get();

        $nationality_ids = $nationalities->pluck('id')->toArray();
        $nats_assign = array_fill_keys($nationality_ids, false);

        foreach ($entries as $entry) {
            foreach ($entry->nationalities as $nat) {
                $nats_assign[$nat->id] = true;
            }
        }
        foreach ($nats_assign as $nat_id => $assign) {
            $nationalities->find($nat_id)->assign = $assign;
        }

        return view('entries.check.natassign', compact('country', 'nationalities'));
    }

    public function check_countrynat_time()
    {
        $start_time = microtime(true);
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

        $a = json_encode($checkArr);

        $count = 1;
        foreach($checkArr as $keyCheckArrCountry => $valueCheckArrCountry) {
            $codeCountry = $keyCheckArrCountry;
            foreach($valueCheckArrCountry as $keyCheckArrNat => $valueCheckArrNat) {
                $codeNat = $keyCheckArrNat;
                $tcode = $codeCountry . "-" . $codeNat;
                echo $count . " - " . $tcode;
                $count++;
            }
        }


        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        echo " Execution time of script = ".$execution_time." sec";
        exit;
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

                $entryByCountry = DB::table('entries')
                    ->select('entries.id', 'entries.countrytocode')
                    ->join('nationalitiables', 'entries.id', '=', 'nationalitiables.nationalitiable_id')
                    ->join('nationalities', 'nationalitiables.nationality_id', 'nationalities.id')
                    ->where('entries.countrytocode', '=', $codeCountry)
                    ->where('entries.active', '=', 1)
                    ->where('nationalities.code', '=', $codeNat)
                    ->where('nationalitiables.nationalitiable_type', '=', 'App\Models\Entry')
                    ->get()
                    ->toArray();


                if (count($entryByCountry) == 0) {
                    $checkArr1[$codeCountry][$codeNat]['type'] = 0;
                    $checkArr1[$codeCountry][$codeNat]['info'] = "no data found for this nationality";
                } elseif (count($entryByCountry) == 1)  {

                } else {
                    $checkArr1[$codeCountry][$codeNat]['type'] = 2;
                    $checkArr1[$codeCountry][$codeNat]['info'] = "more than one active record found for this nationality";
                }
            }
        }

        return view('entries.check.assign', compact('checkArr1'));
    }

    public function preview(EntryFormRequest $request)
    {
        try {
            $language = Language::where('code', 'en')->firstOrFail();
            $preview = Entry::getPreview($request, $language);

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
            $entry = Entry::findOrFail($id);
            $language = Language::where('code', $request->lang)->firstOrFail();

            $report = $entry->getReport($language);

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
