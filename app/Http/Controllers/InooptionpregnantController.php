<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InooptionpregnantFormRequest;
use App\Models\Inooptionpregnant;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class InooptionpregnantController extends Controller
{
    /**
     * Display a listing of the inooptionpregnants.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('inooptionpregnants.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('inooptionpregnants.create', compact('languages'));
    }

    /**
     * Store a new inooptionpregnant in the storage.
     *
     * @param App\Http\Requests\InooptionpregnantFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(InooptionpregnantFormRequest $request)
    {
        try {

            $data = $request->getData();
            $inooptionpregnant = Inooptionpregnant::create($data);
            $inooptionpregnant->created_user = Auth::user()->id;
            $inooptionpregnant->created_ip = $request->ip();
            $inooptionpregnant->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $inooptionpregnant->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $inooptionpregnant->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 15;   // Inooption Pregnant
            $useraction->comment = $inooptionpregnant->content;
            $useraction->lang = $inooptionpregnant->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();


            return redirect()->route('inooptionpregnants.index')
                ->with('success_message', 'Inooptionpregnant was successfully added.');
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
        $inooptionpregnant = Inooptionpregnant::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $inooptionpregnant->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('inooptionpregnants.show', compact('inooptionpregnant', 'languages'));
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
        $inooptionpregnant = Inooptionpregnant::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $inooptionpregnant->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('inooptionpregnants.edit', compact('inooptionpregnant', 'languages'));
    }

    /**
     * Update the specified inooptionpregnant in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\InooptionpregnantFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, InooptionpregnantFormRequest $request)
    {
        try {

            $data = $request->getData();

            $inooptionpregnant = Inooptionpregnant::findOrFail($id);
            $inooptionpregnant->update($data);
            $inooptionpregnant->updated_user = Auth::user()->id;
            $inooptionpregnant->updated_ip = $request->ip();
            $inooptionpregnant->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $inooptionpregnant->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $inooptionpregnant->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $inooptionpregnant->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 15;   // Inooption Pregnant
            $useraction->comment = $inooptionpregnant->content;
            $useraction->lang = $inooptionpregnant->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();


            return redirect()->route('inooptionpregnants.index')
                ->with('success_message', 'Inooptionpregnant was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified inooptionpregnant from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $inooptionpregnant = Inooptionpregnant::findOrFail($id);
            $inooptionpregnant->delete();

            return redirect()->route('inooptionpregnants.index')
                ->with('success_message', 'Inooptionpregnant was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
