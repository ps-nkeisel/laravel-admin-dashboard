<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserswebFormRequest;
use App\Models\Usersweb;
use App\Models\Adrheadsoftwareprovider;
use App\Models\Adrheadcooperation;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Adrheadtag;
use App\Models\Useraction;
use Exception;
use Auth;

class UserswebController extends Controller
{

    /**
     * Display a listing of the usersweb.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $adrheadcooperations = Adrheadcooperation::where('active', 1)->get();
        $adrheadtags = Adrheadtag::where('active', 1)->get();

        return view('usersweb.index', compact('adrheadcooperations', 'adrheadtags'));
    }

    /**
     * Show the form for creating a new usersweb.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $adrheadsoftwareproviders = Adrheadsoftwareprovider::where('active', 1)->get();
        $adrheadcooperations = Adrheadcooperation::where('active', 1)->get();
        $countries = Country::where('active', 1)->get();
        $nationalities = Nationality::where('active', 1)->get();
        $adrheadtags = Adrheadtag::where('active', 1)->get();

        foreach ($countries as $country) {
            $country->code = strtolower($country->code);
        }
        foreach ($nationalities as $nationality) {
            $nationality->code = strtolower($nationality->code);
        }

        return view('usersweb.create', compact('adrheadsoftwareproviders', 'adrheadcooperations', 'countries', 'nationalities', 'adrheadtags'));
    }

    /**
     * Store a new usersweb in the storage.
     *
     * @param App\Http\Requests\UserswebFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UserswebFormRequest $request)
    {
        try {
            $data = $request->getData();

            $usersweb = Usersweb::create($data);

            $usersweb->created_user = Auth::user()->id;
            $usersweb->created_ip = $request->ip();
            $usersweb->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $usersweb->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 31;   // Usersweb
            $useraction->comment = $usersweb->realname;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('usersweb.show', $usersweb->id)
                ->with('success_message', 'Usersweb was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified usersweb.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $usersweb = Usersweb::findOrFail($id);

        $usersweb->adrheadsoftwareproviders = Adrheadsoftwareprovider::where('active', 1)->whereIn('code', $usersweb->providers ?? [])->get();
        $usersweb->adrheadsoftwareproviders1 = Adrheadsoftwareprovider::where('active', 1)->whereIn('code', $usersweb->providers1 ?? [])->get();
        $usersweb->adrheadcooperations = Adrheadcooperation::where('active', 1)->whereIn('code', $usersweb->cooperation ?? [])->get();
        $usersweb->countries = Country::where('active', 1)->whereIn('code', $usersweb->favdestination ?? [])->get();
        $usersweb->nationalities = Nationality::where('active', 1)->whereIn('code', $usersweb->favnationality ?? [])->get();
        $usersweb->adrheadtags = Adrheadtag::where('active', 1)->whereIn('code', $usersweb->tags ?? [])->get();

        return view('usersweb.show', compact('usersweb'));
    }

    /**
     * Show the form for editing the specified usersweb.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $usersweb = Usersweb::findOrFail($id);

        $adrheadsoftwareproviders = Adrheadsoftwareprovider::where('active', 1)->get();
        $adrheadcooperations = Adrheadcooperation::where('active', 1)->get();
        $countries = Country::where('active', 1)->get();
        $nationalities = Nationality::where('active', 1)->get();
        $adrheadtags = Adrheadtag::where('active', 1)->get();

        foreach ($countries as $country) {
            $country->code = strtolower($country->code);
        }
        foreach ($nationalities as $nationality) {
            $nationality->code = strtolower($nationality->code);
        }

        return view('usersweb.edit', compact('usersweb', 'adrheadsoftwareproviders', 'adrheadcooperations', 'countries', 'nationalities', 'adrheadtags'));
    }

    /**
     * Update the specified usersweb in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\UserswebFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UserswebFormRequest $request)
    {
        try {
            $data = $request->getData();

            $usersweb = Usersweb::findOrFail($id);
            $usersweb->update($data);

            $usersweb->updated_user = Auth::user()->id;
            $usersweb->updated_ip = $request->ip();
            $usersweb->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $usersweb->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 31;   // Usersweb
            $useraction->comment = $usersweb->realname;
            $useraction->lang = '';
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('usersweb.show', $usersweb->id)
                ->with('success_message', 'Usersweb was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified usersweb from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $usersweb = Usersweb::findOrFail($id);
            $usersweb->delete();

            return redirect()->route('usersweb.index')
                ->with('success_message', 'Usersweb was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
