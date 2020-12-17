<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contentadditional;
use App\Models\Language;
use File;
use Response;

class ContentadditionalController extends Controller
{
    public function index()
    {
        $languages = Language::where('active', 1)->orderBy('position', 'asc')->get();

        return view('contentadditionals.index', compact('languages'));
    }

    public function export($lang)
    {
        $language = Language::where('code', $lang)->first();
        $contentadditionals = Contentadditional::with('languages')->where('active', 1)->get();

        $data = [];
        foreach ($contentadditionals as $contentadditional) {
            $languageContent = $contentadditional->languages->find($language->id);
            if ($languageContent) {
                array_push($data, [
                    'id' => $contentadditional->id,
                    'lang' => $lang,
                    'headline' => $languageContent->pivot->headline,
                    'content' => $languageContent->pivot->content
                ]);
            }
        }
        $data = json_encode($data);

        $curtime = time();

        $dirPath = 'storage/uploads';
        $fileName = "contentadditionals_{$lang}_{$curtime}.json";
        $filePath = $dirPath.'/'.$fileName;

        File::put($filePath, $data);
        return response()->download($filePath)->deleteFileAfterSend();
    }
}
