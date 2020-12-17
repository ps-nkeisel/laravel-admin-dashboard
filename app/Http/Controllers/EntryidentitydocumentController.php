<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryidentitydocumentFormRequest;
use App\Models\Entryidentitydocument;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class EntryidentitydocumentController extends Controller
{
    /**
     * Display a listing of the entryidentitydocuments.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('entryidentitydocuments.index');
    }

    /**
     * Show the form for creating a new entryidentitydocument.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('entryidentitydocuments.create', compact('languages'));
    }

    /**
     * Store a new entryidentitydocument in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EntryidentitydocumentFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entryidentitydocument = Entryidentitydocument::create($data);
            $entryidentitydocument->created_user = Auth::user()->id;
            $entryidentitydocument->created_ip = $request->ip();
            $entryidentitydocument->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $entryidentitydocument->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entryidentitydocument->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 20;   // Entryidentitydocument
            $useraction->comment = $entryidentitydocument->content;
            $useraction->lang = $entryidentitydocument->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entryidentitydocuments.index')
                ->with('success_message', 'Entryidentitydocument was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified entryidentitydocument.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $entryidentitydocument = Entryidentitydocument::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entryidentitydocument->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entryidentitydocuments.show', compact('entryidentitydocument', 'languages'));
    }

    /**
     * Show the form for editing the specified entryidentitydocument.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $entryidentitydocument = Entryidentitydocument::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entryidentitydocument->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entryidentitydocuments.edit', compact('entryidentitydocument', 'languages'));
    }

    /**
     * Update the specified entryidentitydocument in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EntryidentitydocumentFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entryidentitydocument = Entryidentitydocument::findOrFail($id);
            $entryidentitydocument->update($data);
            $entryidentitydocument->updated_user = Auth::user()->id;
            $entryidentitydocument->updated_ip = $request->ip();
            $entryidentitydocument->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $entryidentitydocument->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $entryidentitydocument->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entryidentitydocument->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 20;   // Entryidentitydocument
            $useraction->comment = $entryidentitydocument->content;
            $useraction->lang = $entryidentitydocument->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entryidentitydocuments.index')
                ->with('success_message', 'Entryidentitydocument was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified entryidentitydocument from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $entryidentitydocument = Entryidentitydocument::findOrFail($id);
            $entryidentitydocument->delete();

            return redirect()->route('entryidentitydocuments.index')
                ->with('success_message', 'Entryidentitydocument was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
