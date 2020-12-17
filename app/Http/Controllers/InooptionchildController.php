<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InooptionchildFormRequest;
use App\Models\Inooptionchild;
use App\Models\Useraction;
use App\Models\Language;
use Exception;
use Auth;

class InooptionchildController extends Controller
{
    /**
     * Display a listing of the inooptionchildren.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('inooptionchildren.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('inooptionchildren.create', compact('languages'));
    }

    /**
     * Store a new inooptionchild in the storage.
     *
     * @param App\Http\Requests\InooptionchildFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(InooptionchildFormRequest $request)
    {
        try {

            $data = $request->getData();
            $inooptionchild = Inooptionchild::create($data);
            $inooptionchild->created_user = Auth::user()->id;
            $inooptionchild->created_ip = $request->ip();
            $inooptionchild->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = Language::find($lang);
                    $inooptionchild->languages()->save($language, ['content' => $content]);
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $inooptionchild->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 14;   // Inooption Child
            $useraction->comment = $inooptionchild->content;
            $useraction->lang = $inooptionchild->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();


            return redirect()->route('inooptionchildren.index')
                ->with('success_message', 'Inooptionchild was successfully added.');
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
        $inooptionchild = Inooptionchild::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $inooptionchild->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('inooptionchildren.show', compact('inooptionchild', 'languages'));
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
        $inooptionchild = Inooptionchild::findOrFail($id);

        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        foreach ($languages as $language) {
            $lang = $inooptionchild->languages->find($language->id);
            if ($lang) {
                $language->languageContent = $lang->pivot->content;
            }
        }

        return view('inooptionchildren.edit', compact('inooptionchild', 'languages'));
    }

    /**
     * Update the specified inooptionchild in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\InooptionchildFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, InooptionchildFormRequest $request)
    {
        try {

            $data = $request->getData();

            $inooptionchild = Inooptionchild::findOrFail($id);
            $inooptionchild->update($data);
            $inooptionchild->updated_user = Auth::user()->id;
            $inooptionchild->updated_ip = $request->ip();
            $inooptionchild->save();

            $langContents = $request->getLanguageContents();
            foreach ($langContents as $lang => $content) {
                if (!empty(trim($content))) {
                    $language = $inooptionchild->languages->find($lang);
                    if ($language) {
                        $language->pivot->content = $content;
                        $language->pivot->save();
                    } else {
                        $language = Language::find($lang);
                        $inooptionchild->languages()->save($language, ['content' => $content]);
                    }
                }
            }

            $useraction = new Useraction;
            $useraction->assigntonew = $inooptionchild->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 14;   // Inooption Child
            $useraction->comment = $inooptionchild->content;
            $useraction->lang = $inooptionchild->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('inooptionchildren.index')
                ->with('success_message', 'Inooptionchild was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified inooptionchild from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $inooptionchild = Inooptionchild::findOrFail($id);
            $inooptionchild->delete();

            return redirect()->route('inooptionchildren.index')
                ->with('success_message', 'Inooptionchild was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
