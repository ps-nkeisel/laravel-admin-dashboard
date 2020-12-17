<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransitvisainfoFormRequest;
use App\Models\Transitvisainfo;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class TransitvisainfoController extends Controller
{
    /**
     * Display a listing of the transitvisainfos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('transitvisainfos.index');
    }

    /**
     * Show the form for creating a new transitvisainfo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('transitvisainfos.create', compact('languages'));
    }

    /**
     * Store a new transitvisainfo in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TransitvisainfoFormRequest $request)
    {
        try {

            $data = $request->getData();

            $transitvisainfo = Transitvisainfo::create($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $transitvisainfo->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $transitvisainfo->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 30;   // Transitvisainfo
            $useraction->comment = $transitvisainfo->content;
            $useraction->lang = $transitvisainfo->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('transitvisainfos.index')
                ->with('success_message', 'Transitvisainfo was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified transitvisainfo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $transitvisainfo = Transitvisainfo::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $transitvisainfo->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('transitvisainfos.show', compact('transitvisainfo', 'languages'));
    }

    /**
     * Show the form for editing the specified transitvisainfo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $transitvisainfo = Transitvisainfo::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $transitvisainfo->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('transitvisainfos.edit', compact('transitvisainfo', 'languages'));
    }

    /**
     * Update the specified transitvisainfo in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TransitvisainfoFormRequest $request)
    {
        try {

            $data = $request->getData();

            $transitvisainfo = Transitvisainfo::findOrFail($id);
            $transitvisainfo->update($data);

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $transitvisainfo->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $transitvisainfo->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $transitvisainfo->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 30;   // Transitvisainfo
            $useraction->comment = $transitvisainfo->content;
            $useraction->lang = $transitvisainfo->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('transitvisainfos.index')
                ->with('success_message', 'Transitvisainfo was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified transitvisainfo from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $transitvisainfo = Transitvisainfo::findOrFail($id);
            $transitvisainfo->delete();

            return redirect()->route('transitvisainfos.index')
                ->with('success_message', 'Transitvisainfo was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
