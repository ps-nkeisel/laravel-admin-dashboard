<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Content;

class ContentController extends Controller
{
    public function search(Request $request) {
        $query = Content::with(['language', 'contentcategory']);

        $filters = $request->filters;
        if (isset($filters['category_ids']) && sizeof($filters['category_ids'])) {
            $category_ids = $filters['category_ids'];
            if (!in_array(0, $category_ids)) {      // not selected 'All'
                $query->whereIn('category', $category_ids);
            }
        }
        if (isset($filters['language_ids']) && sizeof($filters['language_ids'])) {
            $language_ids = $filters['language_ids'];
            if (!in_array(0, $language_ids)) {      // not selected 'All'
                $query->whereIn('lang', $language_ids);
            }
        }
        if (isset($filters['time_containment']) && $filters['time_containment'] != 'all') {
            $time_containment = $filters['time_containment'];
            $from = '';
            $to = '';
            if ($time_containment == 'today') {
                $from = Carbon::now()->yesterday();
                $to = Carbon::now()->tomorrow();
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
        $query->where(function ($que) use ($filters) {
            $active = (isset($filters['active']) && $filters['active'] == '1') ? 1 : 0;
            $archive = (isset($filters['archive']) && $filters['archive'] == '1') ? 1 : 0;
            if ($active && $archive) {
                $que->where('active', $active)
                    ->orWhere('archive', $archive);
            } else {
                $que->where('active', $active)->where('archive', $archive);
            }
        });
        if (isset($filters['code1'])) {
            $query->where('code1', 'LIKE', "%{$filters['code1']}%");
        }
        if (isset($filters['version'])) {
            $query->where('version', $filters['version']);
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

        $total = $query->get()->count();
        $data = $query->orderBy($order_col, $order_dir)->offset($start)->take($length)->get();
        $data = array_values($data->toArray());

        return response()->json([
        	'recordsTotal' => $total,
        	'recordsFiltered' => $total,
            'data' => $data
        ]);
    }

    public function compare(Request $request) {
        return response()->json([
            'content1' => Content::with(['language'])->findOrFail($request->id1),
            'content2' => Content::with(['language'])->findOrFail($request->id2),
        ]);
    }
}
