<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryaddinfoFormRequest;
use App\Models\Entryaddinfo;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class EntryaddinfoController extends Controller
{
    /**
     * Display a listing of the entryaddinfos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('entryaddinfos.index');
    }

    /**
     * Show the form for creating a new entryaddinfo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('entryaddinfos.create', compact('languages'));
    }

    /**
     * Store a new entryaddinfo in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EntryaddinfoFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entryaddinfo = Entryaddinfo::create($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $entryaddinfo->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entryaddinfo->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 22;   // Entryaddinfo
            $useraction->comment = $entryaddinfo->content;
            $useraction->lang = $entryaddinfo->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entryaddinfos.index')
                ->with('success_message', 'Entryaddinfo was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified entryaddinfo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $entryaddinfo = Entryaddinfo::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entryaddinfo->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entryaddinfos.show', compact('entryaddinfo', 'languages'));
    }

    /**
     * Show the form for editing the specified entryaddinfo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $entryaddinfo = Entryaddinfo::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $entryaddinfo->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('entryaddinfos.edit', compact('entryaddinfo', 'languages'));
    }

    /**
     * Update the specified entryaddinfo in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EntryaddinfoFormRequest $request)
    {
        try {

            $data = $request->getData();

            $entryaddinfo = Entryaddinfo::findOrFail($id);
            $entryaddinfo->update($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $entryaddinfo->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $entryaddinfo->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $entryaddinfo->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 22;   // Entryaddinfo
            $useraction->comment = $entryaddinfo->content;
            $useraction->lang = $entryaddinfo->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('entryaddinfos.index')
                ->with('success_message', 'Entryaddinfo was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified entryaddinfo from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $entryaddinfo = Entryaddinfo::findOrFail($id);
            $entryaddinfo->delete();

            return redirect()->route('entryaddinfos.index')
                ->with('success_message', 'Entryaddinfo was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
