<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadtagFormRequest;
use App\Models\Adrheadtag;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadtagController extends Controller
{

    /**
     * Display a listing of the adrheadtags.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheadtags.index');
    }

    /**
     * Show the form for creating a new adrheadtag.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('adrheadtags.create');
    }

    /**
     * Store a new adrheadtag in the storage.
     *
     * @param App\Http\Requests\AdrheadtagFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadtagFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadtag = Adrheadtag::create($data);
            $adrheadtag->created_user = Auth::user()->id;
            $adrheadtag->created_ip = $request->ip();
            $adrheadtag->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadtag->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 34;   // Adrheadtag
            $useraction->comment = $adrheadtag->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadtags.index')
                ->with('success_message', 'Adrheadtag was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adrheadtag.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrheadtag = Adrheadtag::findOrFail($id);

        return view('adrheadtags.show', compact('adrheadtag'));
    }

    /**
     * Show the form for editing the specified adrheadtag.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrheadtag = Adrheadtag::findOrFail($id);

        return view('adrheadtags.edit', compact('adrheadtag'));
    }

    /**
     * Update the specified adrheadtag in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadtagFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadtagFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadtag = Adrheadtag::findOrFail($id);
            $adrheadtag->update($data);
            $adrheadtag->updated_user = Auth::user()->id;
            $adrheadtag->updated_ip = $request->ip();
            $adrheadtag->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadtag->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 34;   // Adrheadtag
            $useraction->comment = $adrheadtag->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadtags.index')
                ->with('success_message', 'Adrheadtag was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adrheadtag from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrheadtag = Adrheadtag::findOrFail($id);
            $adrheadtag->delete();

            return redirect()->route('adrheadtags.index')
                ->with('success_message', 'Adrheadtag was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
