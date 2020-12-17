<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Currency;

class CountryController extends Controller
{
    public function search(Request $request) {
        $query = Country::query();

        $columns = [];
        foreach ($request->columns as $col) {
            array_push($columns, $col['data']);
        }

        $query->where(\DB::raw('CONCAT_WS(" ", '.implode(",", $columns).')'), 'LIKE', "%{$request->search['value']}%");

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

    public function search_by_code(Request $request) {
        try {
            $code = $request->code;
            $country = Country::where('code', $code)->firstOrFail();

            return response()->json($country);
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

    public function search_currency(Request $request) {
        try {
            $country_id = $request->id;
            $country = Country::findOrFail($country_id);

            $query = Currency::query()->where('target', $country->currencycode);

            $columns = [];
            foreach ($request->columns as $col) {
                array_push($columns, $col['data']);
            }

            $query->where(\DB::raw('CONCAT_WS(" ", '.implode(",", $columns).')'), 'LIKE', "%{$request->search['value']}%");

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
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ], 404);
        }
    }

}
