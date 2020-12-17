<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Translation;

class TranslationController extends Controller
{
    public function search(Request $request) {
        $query = Translation::query();

        $filters = $request->filters;
        if (isset($filters['code'])) {
            $query->where('code', 'LIKE', "%{$filters['code']}%");
        }
        if (isset($filters['item'])) {
            $query->where('item', 'LIKE', "%{$filters['item']}%");
        }
        if (isset($filters['text'])) {
            $query->where('text', 'LIKE', "%{$filters['text']}%");
        }

        $columns = [];
        foreach ($request->columns as $col) {
            array_push($columns, $col['data']);
        }

        $order_col_index = $request->order[0]['column'];
        $order_col = $columns[$order_col_index];
        $order_dir = $request->order[0]['dir'];

        $start = $request->start;
        $length = $request->length;

        $result = $query->get();
        $data = $query->orderBy($order_col, $order_dir)->offset($start)->take($length)->get();
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $result->count(),
        	'recordsFiltered' => $result->count(),
            'data' => $data
        ]);
    }
}
