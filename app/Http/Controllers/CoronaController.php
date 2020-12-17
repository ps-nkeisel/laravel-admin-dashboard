<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\CoronaFormRequest;
use App\Models\Corona;
use App\Models\Useraction;
use Exception;
use Illuminate\Support\Facades\Auth;

class CoronaController extends Controller
{
    /**
     * Display a listing of corona.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('corona.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('corona.create');
    }

    /**
     * Store a new corona in the storage.
     *
     * @param App\Http\Requests\CoronaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CoronaFormRequest $request)
    {
        try {

            $data = $request->getData();

            $corona = Corona::create($data);
            $corona->created_user = Auth::user()->id;
            $corona->created_ip = $request->ip();
            $corona->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $corona->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 36;   // Corona
            $useraction->comment = $corona->countrycode;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('corona.index')
                ->with('success_message', 'Corona Info was successfully added.');
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
        $corona = Corona::findOrFail($id);

        return view('corona.show', compact('corona'));
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
        $corona = Corona::findOrFail($id);

        return view('corona.edit', compact('corona'));
    }

    /**
     * Update the specified nationality in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\CoronaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CoronaFormRequest $request)
    {
        try {

            $data = $request->getData();

            $corona = Corona::findOrFail($id);
            $corona->update($data);
            $corona->updated_user = Auth::user()->id;
            $corona->updated_ip = $request->ip();
            $corona->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $corona->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 36;   // Corona
            $useraction->comment = $corona->countrycode;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('corona.index')
                ->with('success_message', 'Corona info was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
