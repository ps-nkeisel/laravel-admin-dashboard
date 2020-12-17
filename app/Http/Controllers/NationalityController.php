<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalityFormRequest;
use App\Models\Nationality;
use Exception;

class NationalityController extends Controller
{
    /**
     * Display a listing of the nationalities.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('nationalities.index');
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('nationalities.create');
    }

    /**
     * Store a new nationality in the storage.
     *
     * @param App\Http\Requests\NationalityFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(NationalityFormRequest $request)
    {
        try {

            $data = $request->getData();

            Nationality::create($data);

            return redirect()->route('nationalities.index')
                ->with('success_message', 'Nationality was successfully added.');
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
        $nationality = Nationality::findOrFail($id);

        return view('nationalities.show', compact('nationality'));
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
        $nationality = Nationality::findOrFail($id);


        return view('nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified nationality in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\NationalityFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, NationalityFormRequest $request)
    {
        try {

            $data = $request->getData();

            $nationality = Nationality::findOrFail($id);
            $nationality->update($data);

            return redirect()->route('nationalities.index')
                ->with('success_message', 'Nationality was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


}
