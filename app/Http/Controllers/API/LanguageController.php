<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class LanguageController extends Controller
{
    public function translate(Request $request) {
        $translation = '';
        try {
            $requestTranslate = new Client();

            $texts = explode(PHP_EOL, $request->text);

            foreach ($texts as $text) {
                $url = 'https://api.deepl.com/v2/translate' .
                    '?auth_key=' . config('app.deepl_api_key') .
                    '&text=' . $text .
                    '&source_lang=' . $request->langSrc .
                    '&target_lang=' . $request->langDst;

                $response = $requestTranslate->get($url);

                $result = $response->getBody(true);
                $result = json_decode($result, true);

                $translation .= $result['translations'][0]['text'].PHP_EOL;
            }
        } catch (RequestException $e) {
            abort($e->getCode(), $e->getMessage());
        }
        return response()->json([
        	'text' => $translation,
        ]);
    }
}
