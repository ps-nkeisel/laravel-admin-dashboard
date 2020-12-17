<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Requestinfo;
use Carbon\Carbon;
use Exception;

class RequestinfoController extends Controller
{
    public function search(Request $request) {
        $query = Requestinfo::query();

        $filters = $request->filters;
        if (isset($filters['userid'])) {
            $query->where('userid', $filters['userid']);
        }
        if (isset($filters['datefrom']) && isset($filters['dateto'])) {
            $datefrom = Carbon::createFromFormat('Y-m-d', $filters['datefrom']);
            $dateto = Carbon::createFromFormat('Y-m-d', $filters['dateto']);
            if ($datefrom !== false && $dateto !== false) {
                $datefrom = $datefrom->startOfDay();
                $dateto = $dateto->endOfDay();
                $query->whereBetween('created_at', [$datefrom, $dateto]);
            }
        }
        if (isset($filters['dest'])) {
            $query->where('dest', 'LIKE', "%{$filters['dest']}%");
        }
        if (isset($filters['nat'])) {
            $query->where('nat', 'LIKE', "%{$filters['nat']}%");
        }
        if (isset($filters['lang'])) {
            $query->where('lang', 'LIKE', "%{$filters['lang']}%");
        }
        if (isset($filters['bookingnr'])) {
            $query->where('bookingnr', $filters['bookingnr']);
        }
        if (isset($filters['traveldate'])) {
            $traveldate = Carbon::createFromFormat('Y-m-d', $filters['traveldate']);
            if ($traveldate !== false) {
                $query->where('traveldate', $filters['traveldate']);
            }
        }
        if (isset($filters['requestid'])) {
            $query->where('requestid', 'LIKE', "%{$filters['requestid']}%");
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

    public function getReport(Request $request) {
        try {
            $request_data = get_request_by_requestid(config('app.firestore_project_id'), $request->request_id);
            if (!isset($request_data['content'])) {
                throw new Exception('Request Content Data not found');
            }
            $retData = json_decode($request_data['content']);
            return response()->json($retData);
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
