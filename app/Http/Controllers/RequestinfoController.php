<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Requestinfo;
use Exception;
use PDF;

class RequestinfoController extends Controller
{
    /**
     * Display the specified
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $request_data = get_request_by_requestid(config('app.firestore_project_id'), $id);
        return response()->json([
        	'date' => $date,
        	'request_id' => $id,
            'request_data' => $request_data,
        ]);
    }

    public function report($id, Request $request)
    {
        try {
            $request_data = get_request_by_requestid(config('app.firestore_project_id'), $id);

            $pdf = PDF::loadView('layouts.pdf.condition', [
                'data' => $request_data
            ]);

            return $pdf->stream();
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

}
