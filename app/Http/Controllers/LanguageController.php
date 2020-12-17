<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Exception;

class LanguageController extends Controller
{
    /**
     * Display a listing of the languages.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::paginate(25);

        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('languages.create');
    }

    /**
     * Store a new language in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            Language::create($data);

            return redirect()->route('languages.index')
                ->with('success_message', 'Language was successfully added.');
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
        $language = Language::findOrFail($id);

        return view('languages.show', compact('language'));
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
        $language = Language::findOrFail($id);


        return view('languages.edit', compact('language'));
    }

    /**
     * Update the specified language in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $language = Language::findOrFail($id);
            $language->update($data);

            return redirect()->route('languages.index')
                ->with('success_message', 'Language was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'active' => 'nullable|boolean',
            'code' => 'nullable|string|min:0|max:2',
            'content' => 'nullable|string|min:0|max:40',
            'created_ip' => 'nullable|string|min:0|max:45',
            'created_user' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'language' => 'nullable|numeric|string|min:0|max:2',
            'position' => 'nullable|numeric|min:-2147483648|max:2147483647',
        ];

        $data = $request->validate($rules);

        $data['active'] = $request->has('active');

        return $data;
    }

}
