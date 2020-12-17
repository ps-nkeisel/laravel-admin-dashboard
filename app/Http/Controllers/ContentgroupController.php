<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentgroupFormRequest;
use App\Models\Contentgroup;
use App\Models\Useraction;
use Exception;
use Auth;

class ContentgroupController extends Controller
{

    /**
     * Display a listing of the contentgroups.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('contentgroups.index');
    }

    /**
     * Show the form for creating a new contentgroup.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('contentgroups.create');
    }

    /**
     * Store a new contentgroup in the storage.
     *
     * @param App\Http\Requests\ContentgroupFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ContentgroupFormRequest $request)
    {
        try {

            $data = $request->getData();

            $contentgroup = Contentgroup::create($data);
            $contentgroup->created_user = Auth::user()->id;
            $contentgroup->created_ip = $request->ip();
            $contentgroup->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $contentgroup->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 28;   // Contentgroup
            $useraction->comment = $contentgroup->content;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('contentgroups.index')
                ->with('success_message', 'Contentgroup was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified contentgroup.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $contentgroup = Contentgroup::findOrFail($id);

        return view('contentgroups.show', compact('contentgroup'));
    }

    /**
     * Show the form for editing the specified contentgroup.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $contentgroup = Contentgroup::findOrFail($id);

        return view('contentgroups.edit', compact('contentgroup'));
    }

    /**
     * Update the specified contentgroup in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ContentgroupFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ContentgroupFormRequest $request)
    {
        try {

            $data = $request->getData();

            $contentgroup = Contentgroup::findOrFail($id);
            $contentgroup->update($data);
            $contentgroup->updated_user = Auth::user()->id;
            $contentgroup->updated_ip = $request->ip();
            $contentgroup->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $contentgroup->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 28;   // Contentgroup
            $useraction->comment = $contentgroup->content;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('contentgroups.index')
                ->with('success_message', 'Contentgroup was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified contentgroup from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $contentgroup = Contentgroup::findOrFail($id);
            $contentgroup->delete();

            return redirect()->route('contentgroups.index')
                ->with('success_message', 'Contentgroup was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }



}
