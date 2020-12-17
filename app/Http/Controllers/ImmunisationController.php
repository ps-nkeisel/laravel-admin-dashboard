<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImmunisationFormRequest;
use App\Models\Immunisation;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class ImmunisationController extends Controller
{
    /**
     * Display a listing of the immunisations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('immunisations.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('immunisations.create', compact('languages'));
    }

    /**
     * Store a new immunisation in the storage.
     *
     * @param App\Http\Requests\ImmunisationFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ImmunisationFormRequest $request)
    {
        try {

            $data = $request->getData();

            $immunisation = Immunisation::create($data);
            $immunisation->created_user = Auth::user()->id;
            $immunisation->created_ip = $request->ip();
            $immunisation->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $immunisation->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $immunisation->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 13;   // Immunisation
            $useraction->comment = $immunisation->content;
            $useraction->lang = $immunisation->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('immunisations.index')
                ->with('success_message', 'Immunisation was successfully added.');
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
        $immunisation = Immunisation::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $immunisation->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('immunisations.show', compact('immunisation', 'languages'));
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
        $immunisation = Immunisation::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $immunisation->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('immunisations.edit', compact('immunisation', 'languages'));
    }

    /**
     * Update the specified immunisation in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ImmunisationFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ImmunisationFormRequest $request)
    {
        try {

            $data = $request->getData();

            $immunisation = Immunisation::findOrFail($id);
            $immunisation->update($data);
            $immunisation->updated_user = Auth::user()->id;
            $immunisation->updated_ip = $request->ip();
            $immunisation->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $immunisation->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $immunisation->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $immunisation->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 13;   // Immunisation
            $useraction->comment = $immunisation->content;
            $useraction->lang = $immunisation->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('immunisations.index')
                ->with('success_message', 'Immunisation was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified immunisation from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $immunisation = Immunisation::findOrFail($id);
            $immunisation->delete();

            return redirect()->route('immunisations.index')
                ->with('success_message', 'Immunisation was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
