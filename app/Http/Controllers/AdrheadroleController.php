<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadroleFormRequest;
use App\Models\Adrheadrole;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadroleController extends Controller
{

    /**
     * Display a listing of the adrheadroles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheadroles.index');
    }

    /**
     * Show the form for creating a new adrheadrole.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('adrheadroles.create');
    }

    /**
     * Store a new adrheadrole in the storage.
     *
     * @param App\Http\Requests\AdrheadroleFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadroleFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadrole = Adrheadrole::create($data);
            $adrheadrole->created_user = Auth::user()->id;
            $adrheadrole->created_ip = $request->ip();
            $adrheadrole->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadrole->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 27;   // Adrheadrole
            $useraction->comment = $adrheadrole->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadroles.index')
                ->with('success_message', 'Adrheadrole was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adrheadrole.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrheadrole = Adrheadrole::findOrFail($id);

        return view('adrheadroles.show', compact('adrheadrole'));
    }

    /**
     * Show the form for editing the specified adrheadrole.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrheadrole = Adrheadrole::findOrFail($id);

        return view('adrheadroles.edit', compact('adrheadrole'));
    }

    /**
     * Update the specified adrheadrole in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadroleFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadroleFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadrole = Adrheadrole::findOrFail($id);
            $adrheadrole->update($data);
            $adrheadrole->updated_user = Auth::user()->id;
            $adrheadrole->updated_ip = $request->ip();
            $adrheadrole->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadrole->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 27;   // Adrheadrole
            $useraction->comment = $adrheadrole->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadroles.index')
                ->with('success_message', 'Adrheadrole was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adrheadrole from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrheadrole = Adrheadrole::findOrFail($id);
            $adrheadrole->delete();

            return redirect()->route('adrheadroles.index')
                ->with('success_message', 'Adrheadrole was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
