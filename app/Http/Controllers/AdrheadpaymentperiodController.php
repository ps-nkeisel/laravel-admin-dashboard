<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadpaymentperiodFormRequest;
use App\Models\Adrheadpaymentperiod;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadpaymentperiodController extends Controller
{

    /**
     * Display a listing of the adrheadpaymentperiodes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheadpaymentperiodes.index');
    }

    /**
     * Show the form for creating a new adrheadpaymentperiod.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('adrheadpaymentperiodes.create');
    }

    /**
     * Store a new adrheadpaymentperiod in the storage.
     *
     * @param App\Http\Requests\AdrheadpaymentperiodFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadpaymentperiodFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadpaymentperiod = Adrheadpaymentperiod::create($data);
            $adrheadpaymentperiod->created_user = Auth::user()->id;
            $adrheadpaymentperiod->created_ip = $request->ip();
            $adrheadpaymentperiod->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadpaymentperiod->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 25;   // Adrheadpaymentperiod
            $useraction->comment = $adrheadpaymentperiod->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadpaymentperiodes.index')
                ->with('success_message', 'Adrheadpaymentperiod was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adrheadpaymentperiod.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrheadpaymentperiod = Adrheadpaymentperiod::findOrFail($id);

        return view('adrheadpaymentperiodes.show', compact('adrheadpaymentperiod'));
    }

    /**
     * Show the form for editing the specified adrheadpaymentperiod.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrheadpaymentperiod = Adrheadpaymentperiod::findOrFail($id);

        return view('adrheadpaymentperiodes.edit', compact('adrheadpaymentperiod'));
    }

    /**
     * Update the specified adrheadpaymentperiod in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadpaymentperiodFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadpaymentperiodFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrheadpaymentperiod = Adrheadpaymentperiod::findOrFail($id);
            $adrheadpaymentperiod->update($data);
            $adrheadpaymentperiod->updated_user = Auth::user()->id;
            $adrheadpaymentperiod->updated_ip = $request->ip();
            $adrheadpaymentperiod->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrheadpaymentperiod->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 25;   // Adrheadpaymentperiod
            $useraction->comment = $adrheadpaymentperiod->content_en;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheadpaymentperiodes.index')
                ->with('success_message', 'Adrheadpaymentperiod was successfully updated.');
        } catch (Exception $exception) {
            dd($exception);
exit();
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adrheadpaymentperiod from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrheadpaymentperiod = Adrheadpaymentperiod::findOrFail($id);
            $adrheadpaymentperiod->delete();

            return redirect()->route('adrheadpaymentperiodes.index')
                ->with('success_message', 'Adrheadpaymentperiod was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
