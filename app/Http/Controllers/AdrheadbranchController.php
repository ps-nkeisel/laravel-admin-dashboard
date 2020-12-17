<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadbranchFormRequest;
use App\Models\Adrheadbranch;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadbranchController extends Controller
{

    /**
     * Display a listing of the adrheadbranches.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheadbranches.index');
    }

    /**
     * Show the form for creating a new adrheadbranch.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('adrheadbranches.create');
    }

    /**
     * Store a new adrheadbranch in the storage.
     *
     * @param App\Http\Requests\AdrheadbranchFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadbranchFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadbranch = Adrheadbranch::create($data);
            $adrheadbranch->created_user = Auth::user()->id;
            $adrheadbranch->created_ip = $request->ip();
            $adrheadbranch->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadbranch->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 26;   // Adrheadbranch
            $useraction->comment = $adrheadbranch->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadbranches.index')
                ->with('success_message', 'Adrheadbranch was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adrheadbranch.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrheadbranch = Adrheadbranch::findOrFail($id);

        return view('adrheadbranches.show', compact('adrheadbranch'));
    }

    /**
     * Show the form for editing the specified adrheadbranch.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrheadbranch = Adrheadbranch::findOrFail($id);

        return view('adrheadbranches.edit', compact('adrheadbranch'));
    }

    /**
     * Update the specified adrheadbranch in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadbranchFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadbranchFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadbranch = Adrheadbranch::findOrFail($id);
            $adrheadbranch->update($data);
            $adrheadbranch->updated_user = Auth::user()->id;
            $adrheadbranch->updated_ip = $request->ip();
            $adrheadbranch->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadbranch->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 26;   // Adrheadbranch
            $useraction->comment = $adrheadbranch->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadbranches.index')
                ->with('success_message', 'Adrheadbranch was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adrheadbranch from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrheadbranch = Adrheadbranch::findOrFail($id);
            $adrheadbranch->delete();

            return redirect()->route('adrheadbranches.index')
                ->with('success_message', 'Adrheadbranch was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
