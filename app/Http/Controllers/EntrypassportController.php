<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntrypassportFormRequest;
use App\Models\Entrypassport;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class EntrypassportController extends Controller
{
    /**
     * Display a listing of the entrypassports.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('entrypassports.index');
    }

    /**
     * Show the form for creating a new entrypassport.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('entrypassports.create', compact('languages'));
    }

    /**
     * Store a new entrypassport in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EntrypassportFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entrypassport = Entrypassport::create($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $entrypassport->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entrypassport->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 21;   // Entrypassport
            $useraction->comment = $entrypassport->content;
            $useraction->lang = $entrypassport->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entrypassports.index')
                ->with('success_message', 'Entrypassport was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified entrypassport.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $entrypassport = Entrypassport::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entrypassport->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entrypassports.show', compact('entrypassport', 'languages'));
    }

    /**
     * Show the form for editing the specified entrypassport.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $entrypassport = Entrypassport::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entrypassport->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entrypassports.edit', compact('entrypassport', 'languages'));
    }

    /**
     * Update the specified entrypassport in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EntrypassportFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entrypassport = Entrypassport::findOrFail($id);
            $entrypassport->update($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $entrypassport->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $entrypassport->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entrypassport->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 21;   // Entrypassport
            $useraction->comment = $entrypassport->content;
            $useraction->lang = $entrypassport->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entrypassports.index')
                ->with('success_message', 'Entrypassport was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified entrypassport from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $entrypassport = Entrypassport::findOrFail($id);
            $entrypassport->delete();

            return redirect()->route('entrypassports.index')
                ->with('success_message', 'Entrypassport was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
