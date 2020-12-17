<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadcooperationFormRequest;
use App\Models\Adrheadcooperation;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadcooperationController extends Controller
{

    /**
     * Display a listing of the adrheadcooperations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheadcooperations.index');
    }

    /**
     * Show the form for creating a new adrheadcooperation.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('adrheadcooperations.create');
    }

    /**
     * Store a new adrheadcooperation in the storage.
     *
     * @param App\Http\Requests\AdrheadcooperationFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadcooperationFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadcooperation = Adrheadcooperation::create($data);
            $adrheadcooperation->created_user = Auth::user()->id;
            $adrheadcooperation->created_ip = $request->ip();
            $adrheadcooperation->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadcooperation->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 32;   // Adrheadcooperation
            $useraction->comment = $adrheadcooperation->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadcooperations.index')
                ->with('success_message', 'Cooperation / Chain was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adrheadcooperation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrheadcooperation = Adrheadcooperation::findOrFail($id);

        return view('adrheadcooperations.show', compact('adrheadcooperation'));
    }

    /**
     * Show the form for editing the specified adrheadcooperation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrheadcooperation = Adrheadcooperation::findOrFail($id);

        return view('adrheadcooperations.edit', compact('adrheadcooperation'));
    }

    /**
     * Update the specified adrheadcooperation in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadcooperationFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadcooperationFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadcooperation = Adrheadcooperation::findOrFail($id);
            $adrheadcooperation->update($data);
            $adrheadcooperation->updated_user = Auth::user()->id;
            $adrheadcooperation->updated_ip = $request->ip();
            $adrheadcooperation->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadcooperation->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 32;   // Adrheadcooperation
            $useraction->comment = $adrheadcooperation->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadcooperations.index')
                ->with('success_message', 'Adrheadcooperation was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adrheadcooperation from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrheadcooperation = Adrheadcooperation::findOrFail($id);
            $adrheadcooperation->delete();

            return redirect()->route('adrheadcooperations.index')
                ->with('success_message', 'Adrheadcooperation was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
