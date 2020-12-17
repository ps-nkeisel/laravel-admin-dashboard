<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InoculationspecificFormRequest;
use App\Models\Inoculationspecific;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class InoculationspecificController extends Controller
{
    /**
     * Display a listing of the inoculationspecifics.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('inoculationspecifics.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('inoculationspecifics.create', compact('languages'));
    }

    /**
     * Store a new inoculationspecific in the storage.
     *
     * @param App\Http\Requests\InoculationspecificFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(InoculationspecificFormRequest $request)
    {
        try {

            $data = $request->getData();
            $inoculationspecific = Inoculationspecific::create($data);
            $inoculationspecific->created_user = Auth::user()->id;
            $inoculationspecific->created_ip = $request->ip();
            $inoculationspecific->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $inoculationspecific->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $inoculationspecific->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 16;   // Inoculation Specific
            $useraction->comment = $inoculationspecific->content;
            $useraction->lang = $inoculationspecific->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();


            return redirect()->route('inoculationspecifics.index')
                ->with('success_message', 'Inoculationspecific was successfully added.');
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
        $inoculationspecific = Inoculationspecific::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $inoculationspecific->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('inoculationspecifics.show', compact('inoculationspecific', 'languages'));
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
        $inoculationspecific = Inoculationspecific::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $inoculationspecific->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('inoculationspecifics.edit', compact('inoculationspecific', 'languages'));
    }

    /**
     * Update the specified inoculationspecific in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\InoculationspecificFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, InoculationspecificFormRequest $request)
    {
        try {

            $data = $request->getData();

            $inoculationspecific = Inoculationspecific::findOrFail($id);
            $inoculationspecific->update($data);
            $inoculationspecific->updated_user = Auth::user()->id;
            $inoculationspecific->updated_ip = $request->ip();
            $inoculationspecific->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $inoculationspecific->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $inoculationspecific->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $inoculationspecific->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 16;   // Inoculation Specific
            $useraction->comment = $inoculationspecific->content;
            $useraction->lang = $inoculationspecific->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();


            return redirect()->route('inoculationspecifics.index')
                ->with('success_message', 'Inoculationspecific was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified inoculationspecific from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $inoculationspecific = Inoculationspecific::findOrFail($id);
            $inoculationspecific->delete();

            return redirect()->route('inoculationspecifics.index')
                ->with('success_message', 'Inoculationspecific was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
