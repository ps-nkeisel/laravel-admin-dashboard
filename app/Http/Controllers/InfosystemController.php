<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfosystemFormRequest;
use App\Models\Infosystem;
use App\Models\Language;
use App\Models\Useraction;
use Exception;
use Auth;

class InfosystemController extends Controller
{
    /**
     * Display a listing of the infosystems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('infosystems.index', compact('languages'));
    }

    /**
     * Show the form for creating a new infosystems.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $color = array(1 => 'dark blue', 2 => 'light blue', 3 => 'green', 4 => 'orange', 5 => 'red');
        $appearance = array(0 => 'no color', 1 => 'green', 2 => 'blue', 3 => 'yellow', 4 => 'red');

        return view('infosystems.create', compact('languages', 'color', 'appearance'));
    }

    /**
     * Store a new infosystem in the storage.
     *
     * @param App\Http\Requests\InfosystemFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(InfosystemFormRequest $request)
    {
        try {
            $data = $request->getData();

            $infosystem = Infosystem::create($data);
            $infosystem->created_user = Auth::user()->id;
            $infosystem->created_ip = $request->ip();
            $infosystem->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $infosystem->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 7;   // Infosystem
            $useraction->comment = $infosystem->content;
            $useraction->lang = $infosystem->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('infosystems.index')
                ->with('success_message', 'Infosystem was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified infosystems.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $infosystem = Infosystem::findOrFail($id);

        $color = array(1 => 'dark blue', 2 => 'light blue', 3 => 'green', 4 => 'orange', 5 => 'red');
        $appearance = array(0 => 'no color', 1 => 'green', 2 => 'blue', 3 => 'yellow', 4 => 'red');

        return view('infosystems.show', compact('infosystem', 'color', 'appearance'));
    }

    /**
     * Show the form for editing the specified infosystems.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $infosystem = Infosystem::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $color = array(1 => 'dark blue', 2 => 'light blue', 3 => 'green', 4 => 'orange', 5 => 'red');
        $appearance = array(0 => 'no color', 1 => 'green', 2 => 'blue', 3 => 'yellow', 4 => 'red');

        return view('infosystems.edit', compact('infosystem', 'languages', 'color', 'appearance'));
    }

    /**
     * Update the specified infosystem in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, InfosystemFormRequest $request)
    {
        try {

            $data = $request->getData($request);

            $infosystem = Infosystem::findOrFail($id);
            $infosystem->update($data);
            $infosystem->updated_user = Auth::user()->id;
            $infosystem->updated_ip = $request->ip();
            $infosystem->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $infosystem->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 7;   // Infosystem
            $useraction->comment = $infosystem->content;
            $useraction->lang = $infosystem->lang;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('infosystems.index')
                ->with('success_message', 'Infosystem was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
