<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Contentadditional;

class ContentadditionalController extends Controller
{
    public function search(Request $request) {
        $query = Contentadditional::query();

        $columns = [];
        foreach ($request->columns as $col) {
            if ($col['data'] != 'headline') {
                array_push($columns, $col['data']);
            }
        }

        $query->where(\DB::raw('CONCAT_WS(" ", '.implode(",", $columns).')'), 'LIKE', "%{$request->search['value']}%");

        $start = $request->start;
        $length = $request->length;

        $result = $query->get();
        $data = $query->orderBy('reminder', 'desc')->offset($start)->take($length)->get();
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $result->count(),
        	'recordsFiltered' => $result->count(),
            'data' => $data
        ]);
    }
}
