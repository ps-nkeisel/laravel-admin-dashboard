<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PassConditionFormRequest;
use App\Pass_condition;
use Exception;

class PassConditionController extends Controller
{
    /**
     * Display a listing of the pass conditions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $passConditions = Pass_condition::paginate(15);

        return view('pass_conditions.index', compact('passConditions'));
    }

    /**
     * Show the form for creating a new pass condition.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('pass_conditions.create');
    }

    /**
     * Store a new pass condition in the storage.
     *
     * @param App\Http\Requests\PassConditionFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PassConditionFormRequest $request)
    {
        try {

            $data = $request->getData();

            Pass_condition::create($data);

            return redirect()->route('pass_conditions.pass_condition.index')
                ->with('success_message', 'Pass Condition was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified pass condition.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $passCondition = Pass_condition::findOrFail($id);

        return view('pass_conditions.show', compact('passCondition'));
    }

    /**
     * Show the form for editing the specified pass condition.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $passCondition = Pass_condition::findOrFail($id);


        return view('pass_conditions.edit', compact('passCondition'));
    }

    /**
     * Update the specified pass condition in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\PassConditionFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PassConditionFormRequest $request)
    {
        try {

            $data = $request->getData();

            $passCondition = Pass_condition::findOrFail($id);
            $passCondition->update($data);

            return redirect()->route('pass_conditions.pass_condition.index')
                ->with('success_message', 'Pass Condition was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified pass condition from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $passCondition = Pass_condition::findOrFail($id);
            $passCondition->delete();

            return redirect()->route('pass_conditions.pass_condition.index')
                ->with('success_message', 'Pass Condition was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
