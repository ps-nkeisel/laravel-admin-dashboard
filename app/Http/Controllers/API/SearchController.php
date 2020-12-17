<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SearchController extends Controller
{
    public function searchCondition(Request $request){
        try {
            $client = new Client();
            $response = $client->request('GET', config('app.api_url').'/condition/search?', [
                'query' => [
                    'aid' => "dh@dhe.de",
                    'apw' => "123456",
                    'sid' => "dh@dhe.de",
                    'sidpw' => "123456",
                    'descd' => 1,
                    'trv' => 1,
                    'ino' => 1,
                    'vis' => 1,
                    'newapi' => 0,
                    'nat' => $request->nat,
                    'destco' => $request->destco,
                    'lang' => $request->lang,
                ]
            ]);

            $responseBody = $response->getBody();
            if ($responseBody=="") {
                throw new \Exception('Unable to send request');
            }

            $result = (array)json_decode($responseBody);

            return $result;
        } catch (RequestException $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

}
