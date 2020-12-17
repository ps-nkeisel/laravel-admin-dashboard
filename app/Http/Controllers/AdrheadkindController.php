<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadkindFormRequest;
use App\Models\Adrheadkind;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadkindController extends Controller
{

    /**
     * Display a listing of the adrheadkinds.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheadkinds.index');
    }

    /**
     * Show the form for creating a new adrheadkind.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('adrheadkinds.create');
    }

    /**
     * Store a new adrheadkind in the storage.
     *
     * @param App\Http\Requests\AdrheadkindFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadkindFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadkind = Adrheadkind::create($data);
            $adrheadkind->created_user = Auth::user()->id;
            $adrheadkind->created_ip = $request->ip();
            $adrheadkind->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadkind->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 25;   // Adrheadkind
            $useraction->comment = $adrheadkind->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadkinds.index')
                ->with('success_message', 'Adrheadkind was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adrheadkind.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrheadkind = Adrheadkind::findOrFail($id);

        return view('adrheadkinds.show', compact('adrheadkind'));
    }

    /**
     * Show the form for editing the specified adrheadkind.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrheadkind = Adrheadkind::findOrFail($id);

        return view('adrheadkinds.edit', compact('adrheadkind'));
    }

    /**
     * Update the specified adrheadkind in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadkindFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadkindFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadkind = Adrheadkind::findOrFail($id);
            $adrheadkind->update($data);
            $adrheadkind->updated_user = Auth::user()->id;
            $adrheadkind->updated_ip = $request->ip();
            $adrheadkind->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadkind->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 25;   // Adrheadkind
            $useraction->comment = $adrheadkind->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadkinds.index')
                ->with('success_message', 'Adrheadkind was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adrheadkind from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrheadkind = Adrheadkind::findOrFail($id);
            $adrheadkind->delete();

            return redirect()->route('adrheadkinds.index')
                ->with('success_message', 'Adrheadkind was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
