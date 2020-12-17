<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UseractionFormRequest;
use App\Models\Useraction;
use App\Models\Useractionsection;
use App\Models\User;
use Exception;

class UseractionController extends Controller
{
    /**
     * Display a listing of the useractions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $users = User::all()->where('active', 1);
        $useractionsections = Useractionsection::orderBy('position', 'asc')->get(['id','content']);

        return view('useractions.index', compact('users', 'useractionsections'));
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('useractions.create');
    }

    /**
     * Store a new useraction in the storage.
     *
     * @param App\Http\Requests\UseractionFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UseractionFormRequest $request)
    {
        try {

            $data = $request->getData();

            Useraction::create($data);

            return redirect()->route('useractions.index')
                ->with('success_message', 'Useraction was successfully added.');
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
        $useraction = Useraction::findOrFail($id);

        return view('useractions.show', compact('useraction'));
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
        $useraction = Useraction::findOrFail($id);


        return view('useractions.edit', compact('useraction'));
    }

    /**
     * Update the specified useraction in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\UseractionFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UseractionFormRequest $request)
    {
        try {

            $data = $request->getData();

            $useraction = Useraction::findOrFail($id);
            $useraction->update($data);

            return redirect()->route('useractions.index')
                ->with('success_message', 'Useraction was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
