<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdrheadFormRequest;
use App\Models\Adrheadbranch;
use App\Models\Adrheadkind;
use App\Models\Adrheadrole;
use App\Models\Adrhead;
use App\Models\Useraction;
use Exception;
use Auth;

class AdrheadController extends Controller
{

    /**
     * Display a listing of the adr heads.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('adrheads.index');
    }

    /**
     * Show the form for creating a new adr head.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $adrheadkinds = Adrheadkind::where('active', 1)->get();
        $adrheadbranches = Adrheadbranch::where('active', 1)->get();
        $adrheadroles = Adrheadrole::where('active', 1)->get();

        return view('adrheads.create', compact('adrheadkinds','adrheadbranches','adrheadroles'));
    }

    /**
     * Store a new adr head in the storage.
     *
     * @param App\Http\Requests\AdrheadFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AdrheadFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrhead = Adrhead::create($data);

            if (isset($request->adr_head_kind_id)) {
                $adrheadkind = Adrheadkind::findOrFail($request->adr_head_kind_id);
                $adrhead->adr_head_kind_id = $adrheadkind->id;
            }
            if (isset($request->adr_head_branch_id)) {
                $adrheadbranch = Adrheadbranch::findOrFail($request->adr_head_branch_id);
                $adrhead->adr_head_branch_id = $adrheadbranch->id;
            }
            if (isset($request->adr_head_role_id)) {
                $adrheadrole = Adrheadrole::findOrFail($request->adr_head_role_id);
                $adrhead->adr_head_role_id = $adrheadrole->id;
            }

            $adrhead->created_user = Auth::user()->id;
            $adrhead->created_ip = $request->ip();
            $adrhead->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrhead->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 24;   // Adrhead
            $useraction->comment = $adrhead->comment;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheads.show', $adrhead->id)
                ->with('success_message', 'Adr head was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified adr head.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $adrhead = Adrhead::with('adrheadkind','adrheadbranch','adrheadrole')->findOrFail($id);

        return view('adrheads.show', compact('adrhead'));
    }

    /**
     * Show the form for editing the specified adr head.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $adrhead = Adrhead::findOrFail($id);
        $adrheadkinds = Adrheadkind::where('active', 1)->get();
        $adrheadbranches = Adrheadbranch::where('active', 1)->get();
        $adrheadroles = Adrheadrole::where('active', 1)->get();

        return view('adrheads.edit', compact('adrhead','adrheadkinds','adrheadbranches','adrheadroles'));
    }

    /**
     * Update the specified adr head in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\AdrheadFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AdrheadFormRequest $request)
    {
        try {

            $data = $request->getData();

            $adrhead = Adrhead::findOrFail($id);
            $adrhead->update($data);

            if (isset($request->adr_head_kind_id)) {
                $adrheadkind = Adrheadkind::findOrFail($request->adr_head_kind_id);
                $adrhead->adr_head_kind_id = $adrheadkind->id;
            }
            if (isset($request->adr_head_branch_id)) {
                $adrheadbranch = Adrheadbranch::findOrFail($request->adr_head_branch_id);
                $adrhead->adr_head_branch_id = $adrheadbranch->id;
            }
            if (isset($request->adr_head_role_id)) {
                $adrheadrole = Adrheadrole::findOrFail($request->adr_head_role_id);
                $adrhead->adr_head_role_id = $adrheadrole->id;
            }

            $adrhead->updated_user = Auth::user()->id;
            $adrhead->updated_ip = $request->ip();
            $adrhead->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $adrhead->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 24;   // Adrhead
            $useraction->comment = $adrhead->content;
            $useraction->lang = $adrhead->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('adrheads.show', $adrhead->id)
                ->with('success_message', 'Adr head was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified adr head from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $adrhead = Adrhead::findOrFail($id);
            $adrhead->delete();

            return redirect()->route('adrheads.index')
                ->with('success_message', 'Adr head was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
