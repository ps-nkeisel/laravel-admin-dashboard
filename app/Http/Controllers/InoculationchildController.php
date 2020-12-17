<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InoculationchildFormRequest;
use App\Models\Inoculationchild;
use Exception;

class InoculationchildController extends Controller
{
    /**
     * Display a listing of the inoculationchildren.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $inoculationchildren = Inoculationchild::paginate(15);

        return view('inoculationchildren.index', compact('inoculationchildren'));
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('inoculationchildren.create');
    }

    /**
     * Store a new inoculationchild in the storage.
     *
     * @param App\Http\Requests\InoculationchildFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(InoculationchildFormRequest $request)
    {
        try {

            $data = $request->getData();

            Inoculationchild::create($data);

            return redirect()->route('inoculationchildren.index')
                ->with('success_message', 'Inoculationchild was successfully added.');
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
        $inoculationchild = Inoculationchild::findOrFail($id);

        return view('inoculationchildren.show', compact('inoculationchild'));
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
        $inoculationchild = Inoculationchild::findOrFail($id);


        return view('inoculationchildren.edit', compact('inoculationchild'));
    }

    /**
     * Update the specified inoculationchild in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\InoculationchildFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, InoculationchildFormRequest $request)
    {
        try {

            $data = $request->getData();

            $inoculationchild = Inoculationchild::findOrFail($id);
            $inoculationchild->update($data);

            return redirect()->route('inoculationchildren.index')
                ->with('success_message', 'Inoculationchild was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified inoculationchild from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $inoculationchild = Inoculationchild::findOrFail($id);
            $inoculationchild->delete();

            return redirect()->route('inoculationchildren.index')
                ->with('success_message', 'Inoculationchild was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
