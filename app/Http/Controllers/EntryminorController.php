<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryminorFormRequest;
use App\Models\Entryminor;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class EntryminorController extends Controller
{
    /**
     * Display a listing of the entryminors.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('entryminors.index');
    }

    /**
     * Show the form for creating a new entryminor.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('entryminors.create', compact('languages'));
    }

    /**
     * Store a new entryminor in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EntryminorFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entryminor = Entryminor::create($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $entryminor->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entryminor->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 23;   // Entryminor
            $useraction->comment = $entryminor->content;
            $useraction->lang = $entryminor->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entryminors.index')
                ->with('success_message', 'Entryminor was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified entryminor.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $entryminor = Entryminor::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entryminor->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entryminors.show', compact('entryminor', 'languages'));
    }

    /**
     * Show the form for editing the specified entryminor.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $entryminor = Entryminor::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entryminor->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entryminors.edit', compact('entryminor', 'languages'));
    }

    /**
     * Update the specified entryminor in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EntryminorFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entryminor = Entryminor::findOrFail($id);
            $entryminor->update($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $entryminor->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $entryminor->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entryminor->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 23;   // Entryminor
            $useraction->comment = $entryminor->content;
            $useraction->lang = $entryminor->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entryminors.index')
                ->with('success_message', 'Entryminor was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified entryminor from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $entryminor = Entryminor::findOrFail($id);
            $entryminor->delete();

            return redirect()->route('entryminors.index')
                ->with('success_message', 'Entryminor was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
