<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationFormRequest;
use App\Models\Translation;
use App\Models\Language;
use App\Models\Useraction;
use Exception;
use Auth;

class TranslationController extends Controller
{
    /**
     * Display a listing of the translations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('translations.index', compact('languages'));
    }

    /**
     * Show the form for creating a new translations.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('translations.create', compact('languages'));
    }

    /**
     * Store a new translation in the storage.
     *
     * @param App\Http\Requests\TranslationFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TranslationFormRequest $request)
    {
        try {
            $data = $request->getData();

            $translation = Translation::create($data);

            $useraction = new Useraction;
            $useraction->assigntonew = $translation->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 19;   // Translation
            $useraction->comment = $translation->text;
            $useraction->lang = $translation->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('translations.index')
                ->with('success_message', 'Translation was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified translations.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $translation = Translation::findOrFail($id);

        return view('translations.show', compact('translation'));
    }

    /**
     * Show the form for editing the specified translations.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $translation = Translation::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('translations.edit', compact('translation', 'languages'));
    }

    /**
     * Update the specified translation in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TranslationFormRequest $request)
    {
        try {

            $data = $request->getData($request);

            $translation = Translation::findOrFail($id);
            $translation->update($data);

            $useraction = new Useraction;
            $useraction->assigntonew = $translation->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 19;   // Translation
            $useraction->comment = $translation->text;
            $useraction->lang = $translation->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('translations.index')
                ->with('success_message', 'Translation was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
