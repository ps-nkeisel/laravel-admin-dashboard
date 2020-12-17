<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadsoftwareproviderFormRequest;
use App\Models\Adrheadsoftwareprovider;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadsoftwareproviderController extends Controller
{

    /**
     * Display a listing of the adrheadsoftwareproviders.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheadsoftwareproviders.index');
    }

    /**
     * Show the form for creating a new adrheadsoftwareprovider.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('adrheadsoftwareproviders.create');
    }

    /**
     * Store a new adrheadsoftwareprovider in the storage.
     *
     * @param App\Http\Requests\AdrheadsoftwareproviderFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadsoftwareproviderFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadsoftwareprovider = Adrheadsoftwareprovider::create($data);
            $adrheadsoftwareprovider->created_user = Auth::user()->id;
            $adrheadsoftwareprovider->created_ip = $request->ip();
            $adrheadsoftwareprovider->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadsoftwareprovider->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 33;   // Adrheadsoftwareprovider
            $useraction->comment = $adrheadsoftwareprovider->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadsoftwareproviders.index')
                ->with('success_message', 'Software provider was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adrheadsoftwareprovider.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrheadsoftwareprovider = Adrheadsoftwareprovider::findOrFail($id);

        return view('adrheadsoftwareproviders.show', compact('adrheadsoftwareprovider'));
    }

    /**
     * Show the form for editing the specified adrheadsoftwareprovider.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrheadsoftwareprovider = Adrheadsoftwareprovider::findOrFail($id);

        return view('adrheadsoftwareproviders.edit', compact('adrheadsoftwareprovider'));
    }

    /**
     * Update the specified adrheadsoftwareprovider in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadsoftwareproviderFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadsoftwareproviderFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadsoftwareprovider = Adrheadsoftwareprovider::findOrFail($id);
            $adrheadsoftwareprovider->update($data);
            $adrheadsoftwareprovider->updated_user = Auth::user()->id;
            $adrheadsoftwareprovider->updated_ip = $request->ip();
            $adrheadsoftwareprovider->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadsoftwareprovider->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 33;   // Adrheadsoftwareprovider
            $useraction->comment = $adrheadsoftwareprovider->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadsoftwareproviders.index')
                ->with('success_message', 'Adrheadsoftwareprovider was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adrheadsoftwareprovider from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrheadsoftwareprovider = Adrheadsoftwareprovider::findOrFail($id);
            $adrheadsoftwareprovider->delete();

            return redirect()->route('adrheadsoftwareproviders.index')
                ->with('success_message', 'Adrheadsoftwareprovider was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
