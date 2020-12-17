<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Infosystem2FormRequest;
use App\Models\Infosystem2;
use App\Models\Language;
use App\Models\Useraction;
use Exception;
use Auth;

class Infosystem2Controller extends Controller
{
    /**
     * Display a listing of the infosystems2.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('infosystems2.index', compact('languages'));
    }

    /**
     * Show the form for creating a new infosystems2.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $color = array(1 => 'dark blue', 2 => 'light blue', 3 => 'green', 4 => 'orange', 5 => 'red');
        $appearance = array(0 => 'no color', 1 => 'green', 2 => 'blue', 3 => 'yellow', 4 => 'red');

        $translation_status = getTranslationStatusArray();

        return view('infosystems2.create', compact('languages', 'color', 'appearance', 'translation_status'));
    }

    /**
     * Store a new infosystem in the storage.
     *
     * @param App\Http\Requests\Infosystem2FormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Infosystem2FormRequest $request)
    {
        try {
            $data = $request->getData();
            $userActionComment = "";

            $infosystem2 = Infosystem2::create($data);
            $infosystem2->created_user = Auth::user()->id;
            $infosystem2->created_ip = $request->ip();
            $infosystem2->save();

            $languageContentsParam = $request->getParams(['languageHeadlines', 'languageContents']);
            $languages = [];

            foreach ($languageContentsParam['languageHeadlines'] as $lang => $headline) {
                $content = $languageContentsParam['languageContents'][$lang];
                if (!empty($headline) || !empty($content)) {
                    $languages[$lang] = [
                        'headline' => $headline,
                        'content' => $content,
                    ];

                    if ($lang == 1) {
                        $userActionComment = $headline;
                    }
                }
            }
            $infosystem2->languages()->sync($languages);

            $useraction = new Useraction;
            $useraction->assigntonew = $infosystem2->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 35;   // Infosystem2
            $useraction->comment = $data['tagdate'] . " - " . $userActionComment;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('infosystems2.index')
                ->with('success_message', 'Infosystem2 was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified infosystems2.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $infosystem2 = Infosystem2::findOrFail($id);

        $color = array(1 => 'dark blue', 2 => 'light blue', 3 => 'green', 4 => 'orange', 5 => 'red');
        $appearance = array(0 => 'no color', 1 => 'green', 2 => 'blue', 3 => 'yellow', 4 => 'red');

        return view('infosystems2.show', compact('infosystem2', 'color', 'appearance'));
    }

    /**
     * Show the form for editing the specified infosystems2.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $infosystem2 = Infosystem2::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        $color = array(1 => 'dark blue', 2 => 'light blue', 3 => 'green', 4 => 'orange', 5 => 'red');
        $appearance = array(0 => 'no color', 1 => 'green', 2 => 'blue', 3 => 'yellow', 4 => 'red');

        $translation_status = getTranslationStatusArray();

        return view('infosystems2.edit', compact('infosystem2', 'languages', 'color', 'appearance', 'translation_status'));
    }

    /**
     * Update the specified infosystem in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Infosystem2FormRequest $request)
    {
        try {

            $data = $request->getData($request);

            $infosystem2 = Infosystem2::findOrFail($id);
            $infosystem2->update($data);
            $infosystem2->updated_user = Auth::user()->id;
            $infosystem2->updated_ip = $request->ip();
            $infosystem2->save();

            $languageContentsParam = $request->getParams(['languageHeadlines', 'languageContents']);
            $languages = [];
            foreach ($languageContentsParam['languageHeadlines'] as $lang => $headline) {
                $content = $languageContentsParam['languageContents'][$lang];
                if (!empty($headline) || !empty($content)) {
                    $languages[$lang] = [
                        'headline' => $headline,
                        'content' => $content,
                    ];
                }
            }
            $infosystem2->languages()->sync($languages);

            $useraction = new Useraction;
            $useraction->assigntonew = $infosystem2->id;
            $useraction->type = 2;         // Record changed
            $useraction->assigntype = 35;   // Infosystem2
            $useraction->comment = $infosystem2->content;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->save();

            return redirect()->route('infosystems2.index')
                ->with('success_message', 'Infosystem2 was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
