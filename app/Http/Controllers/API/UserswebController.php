<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Usersweb;

class UserswebController extends Controller
{
    public function search(Request $request) {
        $query = Usersweb::query();

        $filters = $request->filters;
        if (isset($filters['username'])) {
            $query->where('username', 'LIKE', "%{$filters['username']}%");
        }
        if (isset($filters['realname'])) {
            $query->where('realname', 'LIKE', "%{$filters['realname']}%");
        }
        if (isset($filters['address1'])) {
            $query->where('address1', 'LIKE', "%{$filters['address1']}%");
        }
        if (isset($filters['zip'])) {
            $query->where('zip', $filters['zip']);
        }
        if (isset($filters['agency'])) {
            $query->where('agency', $filters['agency']);
        }
        if (isset($filters['active'])) {
            $query->where('active', $filters['active']);
        }
        if (isset($filters['revised'])) {
            $query->where('revised', $filters['revised']);
        }
        if (isset($filters['cooperation_include']) && sizeof($filters['cooperation_include'])) {
            $cooperation_include = $filters['cooperation_include'];
            foreach ($cooperation_include as $cooperation) {
                $query->where('cooperation', 'LIKE', "%{$cooperation}%");
            }
        }
        if (isset($filters['cooperation_exclude']) && sizeof($filters['cooperation_exclude'])) {
            $cooperation_exclude = $filters['cooperation_exclude'];
            foreach ($cooperation_exclude as $cooperation) {
                $query->where('cooperation', 'NOT LIKE', "%{$cooperation}%");
            }
        }
        if (isset($filters['tags_include']) && sizeof($filters['tags_include'])) {
            $tags_include = $filters['tags_include'];
            foreach ($tags_include as $tags) {
                $query->where('tags', 'LIKE', "%{$tags}%");
            }
        }
        if (isset($filters['tags_exclude']) && sizeof($filters['tags_exclude'])) {
            $tags_exclude = $filters['tags_exclude'];
            foreach ($tags_exclude as $tags) {
                $query->where('tags', 'NOT LIKE', "%{$tags}%");
            }
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

    public function search_assignto(Request $request) {
        $query = Usersweb::where('active', 1);

        if (isset($request->assignto)) {
            $query->where('assignto', $request->assignto);
        }

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
}
