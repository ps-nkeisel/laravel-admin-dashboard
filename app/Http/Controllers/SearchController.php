<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;
use PDF;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $mode = $request->input('mode');
        $nat = $request->input('nat');
        $destco = $request->input('destco');
        $lang = $request->input('lang');

        try {
            $client = new Client();

            $response = $client->request('GET', config('app.api_v2_url')."/content/all/{$mode}", [
                'query' => [
                    'nat' => $nat,
                    'destco' => $destco,
                    'lang' => $lang,
                ],
            ]);

            return response($response->getBody(), 200)
                    ->header('Content-Type', $response->getHeader('Content-Type'));
        } catch (RequestException $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

    public function conditionReport(Request $request)
    {
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

            $pdf = PDF::loadView('layouts.pdf.condition', [
                'data' => $result
            ]);

            return $pdf->stream();
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

}
