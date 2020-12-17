<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryFormRequest;
use App\Models\Country;
use App\Models\Language;
use App\Models\Contentadditional;
use App\Models\Useraction;
use Exception;
use Auth;
use Carbon\Carbon;

class CountryController extends Controller
{
    /**
     * Display a listing of the countries.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('countries.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $contentadditionalSections = Country::getContentadditionalSectionsArray();

        $translation_status = getTranslationStatusArray();

        return view('countries.create', compact('languages', 'contentadditionalSections', 'translation_status'));
    }

    /**
     * Store a new country in the storage.
     *
     * @param  App\Http\Requests\CountryFormRequest  $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CountryFormRequest $request)
    {
        try {

            $data = $request->getData();

            $country = Country::create($data);

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

                $country->contentadditionals()->save($contentadditional);

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

            return redirect()->route('countries.show', $country->id)
                ->with('success_message', 'Country was successfully added.');
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
        $country = Country::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $contentadditionalSections = $country->getContentadditionalSectionsData();

        return view('countries.show', compact('country', 'languages', 'contentadditionalSections'));
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
        $country = Country::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $contentadditionalSections = $country->getContentadditionalSectionsData();

        $translation_status = getTranslationStatusArray();

        return view('countries.edit', compact('country', 'languages', 'translation_status', 'contentadditionalSections'));
    }

    /**
     * Update the specified country in the storage.
     *
     * @param  int  $id
     * @param  App\Http\Requests\CountryFormRequest  $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CountryFormRequest $request)
    {
        try {

            $data = $request->getData();

            $country = Country::findOrFail($id);
            $country->update($data);

            $country->contentadditionals()->update([
                'active' => 0,
                'archive' => 1
            ]);

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

                $country->contentadditionals()->save($contentadditional);

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

            return redirect()->route('countries.show', $country->id)
                ->with('success_message', 'Country was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
