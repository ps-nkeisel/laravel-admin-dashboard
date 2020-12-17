<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentFormRequest;
use App\Models\Content;
use App\Models\Useraction;
use App\Models\Language;
use App\Models\Contentcategory;
use Exception;
use Auth;

class ContentController extends Controller
{
    /**
     * Display a listing of the contents.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $contentcategories = Contentcategory::orderBy('position', 'asc')->get();

        return view('contents.index', compact('languages', 'contentcategories'));
    }

    /**
     * Show the form for creating a new
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $contentcategories = Contentcategory::orderBy('position', 'asc')->get();

        return view('contents.create', compact('languages', 'contentcategories'));
    }

    /**
     * Store a new content in the storage.
     *
     * @param App\Http\Requests\ContentFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ContentFormRequest $request)
    {
        try {

            $data = $request->getData();

            $content = Content::create($data);
            $content->assignto = $content->id;
            $content->version = 1;
            $content->created_user = Auth::user()->id;
            $content->created_ip = $request->ip();
            $content->save();

            $useraction = new Useraction;
            $useraction->assigntonew = $content->id;
            $useraction->type = 1;         // Record created
            $useraction->assigntype = 9;   // Standard Text
            $useraction->lang = $content->lang;
            $useraction->code = $content->code1;
            $useraction->comment = $content->content1;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->version = $content->version;
            $useraction->save();

            return redirect()->route('contents.index')
                ->with('success_message', 'Content was successfully added.');
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
        $content = Content::findOrFail($id);
        if ($content->assignto == 0) {
            $content->assignto = $id;
        }
        $contentversions = Content::with(['createdUser'])->where('assignto', $content->assignto)->where('lang', $content->lang)->orderBy('version', 'desc')->get();

        return view('contents.show', compact('content', 'contentversions'));
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
        $content = Content::findOrFail($id);
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();
        $contentcategories = Contentcategory::orderBy('position', 'asc')->get();

        return view('contents.edit', compact('content', 'languages', 'contentcategories'));
    }

    /**
     * Update the specified content in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ContentFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ContentFormRequest $request)
    {
        try {

            $data = $request->getData();

            $old_content = Content::findOrFail($id);
            $content = $old_content->replicate();
            $content->save();
            $content->update($data);
            $content->version ++;
            $content->created_user = Auth::user()->id;
            $content->created_ip = $request->ip();
            $content->assignto = $old_content->assignto;
            $content->idversionbefore = $old_content->id;
            $content->save();

            $old_content->active = 0;
            $old_content->archive = 1;
            $old_content->updated_user = Auth::user()->id;
            $old_content->updated_ip = $request->ip();
            $old_content->idversionnext = $content->id;
            $old_content->save();

            $useraction = new Useraction;
            $useraction->assigntoold = $old_content->id;
            $useraction->assigntonew = $content->id;
            $useraction->type = 2;         // Record created
            $useraction->assigntype = 9;   // Standard Text
            $useraction->lang = $content->lang;
            $useraction->code = $content->code1;
            $useraction->comment = $content->content1;
            $useraction->created_user = Auth::user()->id;
            $useraction->created_ip = $request->ip();
            $useraction->version = $content->version;
            $useraction->save();

            return redirect()->route('contents.index')
                ->with('success_message', 'Content was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function check_langassign($code1)
    {
        $contents = Content::with('language')->where('active', 1)->where('code1', $code1)->get();
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        foreach ($languages as $language) {
            $content = $contents->where('lang', $language->id)->first();
            if ($content) {
                $language->languageContent = $content->content1;
            }
        }

        return view('contents.check.langassign', compact('code1', 'languages'));
    }

    public function check_assign()
    {
        $arr_code1 = Content::distinct()->get(['code1'])->pluck('code1');

        $unassigned_contents = [];

        foreach ($arr_code1 as $code1) {
            $contents = Content::with('language')->where('active', 1)->where('code1', $code1)->get();
            $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

            $unassigned_languages = $languages->reject(function ($language, $key) use($contents) {
                return $contents->where('lang', $language->id)->count() > 0 ? true : false;
            });

            if ($unassigned_languages->count() > 0) {
                $language_names = implode(', ', $unassigned_languages->pluck('content')->toArray());
                array_push($unassigned_contents,
                    collect([
                        'code1' => $code1,
                        'unassigned_languages' => $language_names
                    ])
                );
            }
        }

        return view('contents.check.assign', compact('unassigned_contents'));
    }

}
