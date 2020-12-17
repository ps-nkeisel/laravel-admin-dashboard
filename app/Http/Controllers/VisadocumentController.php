<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisadocumentFormRequest;
use App\Models\Visadocument;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class VisadocumentController extends Controller
{
    /**
     * Display a listing of the visadocuments.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('visadocuments.index');
    }

    /**
     * Show the form for creating a new visadocument.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('visadocuments.create', compact('languages'));
    }

    /**
     * Store a new visadocument in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(VisadocumentFormRequest $request)
    {
        try {

            $data = $request->getData();

            $visadocument = Visadocument::create($data);
            $visadocument->created_user = Auth::user()->id;
            $visadocument->created_ip = $request->ip();
            $visadocument->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $visadocument->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $visadocument->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 18;   // Visadocument
            $useraction->comment = $visadocument->content;
            $useraction->lang = $visadocument->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('visadocuments.index')
                ->with('success_message', 'Visadocument was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified visadocument.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $visadocument = Visadocument::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $visadocument->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('visadocuments.show', compact('visadocument', 'languages'));
    }

    /**
     * Show the form for editing the specified visadocument.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $visadocument = Visadocument::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $visadocument->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }
        $languageContent = $visadocument->languages()->where('code', 'en')->first();
        if ($languageContent) {
            $visadocument->content = $languageContent->pivot->content;
        }

        return view('visadocuments.edit', compact('visadocument', 'languages'));
    }

    /**
     * Update the specified visadocument in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, VisadocumentFormRequest $request)
    {
        try {

            $data = $request->getData();

            $visadocument = Visadocument::findOrFail($id);
            $visadocument->update($data);
            $visadocument->updated_user = Auth::user()->id;
            $visadocument->updated_ip = $request->ip();
            $visadocument->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $visadocument->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $visadocument->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $visadocument->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 18;   // Visadocument
            $useraction->comment = $visadocument->content;
            $useraction->lang = $visadocument->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('visadocuments.index')
                ->with('success_message', 'Visadocument was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified visadocument from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $visadocument = Visadocument::findOrFail($id);
            $visadocument->delete();

            return redirect()->route('visadocuments.index')
                ->with('success_message', 'Visadocument was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
