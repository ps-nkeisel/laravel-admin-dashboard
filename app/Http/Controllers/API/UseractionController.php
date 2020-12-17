<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Useraction;

class UseractionController extends Controller
{
    public function search(Request $request)
    {
        $query = Useraction::with(['createdUser', 'useractionsection', 'useractiontype', 'language']);

        if (isset($request->time_containment)) {
            $time_containment = $request->time_containment;
            $from = '';
            $to = '';
            if ($time_containment == 'today') {
                $from = Carbon::now()->startOfDay();
                $to = Carbon::now()->endOfDay();
            } else if ($time_containment == 'yesterday') {
                $from = Carbon::now()->subDay()->startOfDay();
                $to = Carbon::now()->subDay()->endOfDay();
            } else if ($time_containment == 'this_week') {
                $from = Carbon::now()->startOfWeek();
                $to = Carbon::now()->endOfWeek();
            } else if ($time_containment == 'last_week') {
                $from = Carbon::now()->subWeek()->startOfWeek();
                $to = Carbon::now()->subWeek()->endOfWeek();
            } else if ($time_containment == 'this_month') {
                $from = Carbon::now()->startOfMonth();
                $to = Carbon::now()->endOfMonth();
            } else if ($time_containment == 'last_month') {
                $from = Carbon::now()->subMonth()->startOfMonth();
                $to = Carbon::now()->subMonth()->endOfMonth();
            } else if ($time_containment == 'this_year') {
                $from = Carbon::now()->startOfYear();
                $to = Carbon::now()->endOfYear();
            } else if ($time_containment == 'last_year') {
                $from = Carbon::now()->subYear()->startOfYear();
                $to = Carbon::now()->subYear()->endOfYear();
            }
            $query->whereBetween('created_at', [$from, $to]);
        }
        if (isset($request->useractionsection_ids) && sizeof($request->useractionsection_ids)) {
            $useractionsection_ids = $request->useractionsection_ids;
            if (!in_array(1, $useractionsection_ids)) {      // not selected 'All'
                $query->whereIn('assigntype', $useractionsection_ids);
            }
        }
        if (isset($request->user_ids) && sizeof($request->user_ids)) {
            $query->whereIn('created_user', $request->user_ids);
        }

        $page = $request->page > 0 ? $request->page : 1;
        $per_page = $request->per_page;
        $total = $query->get()->count();

        $start = ($page-1) * $per_page;
        $data = $query->orderBy('created_at', 'desc')->offset($start)->take($per_page)->get();
        $data = array_values($data->toArray());

        return response()->json([
            'page' => $page,
            'per_page' => $per_page,
        	'total' => $total,
            'data' => $data,
        ]);
    }
}
