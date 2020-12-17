<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Useraction;
use App\Models\Requestinfo;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Test to load request from Firestore
        if (env('PROT_FIRESTORE') == true) {
            //$requestData = get_request_by_requestid(env('FIRESTORE'), '7d910361-0925-4f00-9065-3824fb5eda69');
        }

        /*
        $devEnvLocal = getenv("DEVELOPMENT_ENVIRONMENT_LOCAL");
        if ($devEnvLocal == 1) {
            // write file
            $file_content = "xyyyy";
            Storage::disk('gcs')->put('xyz/test19-12-14_02.txt', $file_content);
            // read file
            //$a = Storage::disk('gcs')->read('xyz/test.txt');
        }
        */

        // actions count this week
        $thisWeekActionCounts = [];
        $fromDate = Carbon::today()->startOfWeek();
        $toDate = Carbon::today()->endOfWeek()->addDay();
        $thisWeekUseractions = Useraction::whereBetween('created_at', [$fromDate, $toDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as counts'))
            ->groupBy('date')
            ->get();
        foreach ($thisWeekUseractions as $useraction) {
            $dateIndex = Carbon::parse($useraction->date)->diffInDays($fromDate);
            $thisWeekActionCounts[$dateIndex] = $useraction->counts;
        }

        // actions count last week
        $lastWeekActionCounts = [];
        $fromDate = Carbon::today()->startOfWeek()->subWeek();
        $toDate = Carbon::today()->endOfWeek()->addDay()->subWeek();
        $lastWeekUseractions = Useraction::whereBetween('created_at', [$fromDate, $toDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as counts'))
            ->groupBy('date')
            ->get();
        foreach ($lastWeekUseractions as $useraction) {
            $dateIndex = Carbon::parse($useraction->date)->diffInDays($fromDate);
            $lastWeekActionCounts[$dateIndex] = $useraction->counts;
        }

        // requests count this week
        $thisWeekRequestCounts = [];
        $fromDate = Carbon::today()->addDay()->subWeek();
        $toDate = Carbon::today()->addDay(1);
        $thisWeekRequests = Requestinfo::whereBetween('created_at', [$fromDate, $toDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as counts'))
            ->groupBy('date')
            ->get();
        foreach ($thisWeekRequests as $request) {
            $dateIndex = Carbon::parse($request->date)->diffInDays($fromDate);
            $thisWeekRequestCounts[$dateIndex] = $request->counts;
        }

        // requests count last week
        $lastWeekRequestCounts = [];
        $fromDate = Carbon::today()->addDay()->subWeek(2);
        $toDate = Carbon::today()->addDay(1)->subWeek();
        DB::enableQueryLog();
        $lastWeekRequests = Requestinfo::whereBetween('created_at', [$fromDate, $toDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as counts'))
            ->groupBy('date')
            ->get();
        foreach ($lastWeekRequests as $request) {
            $dateIndex = Carbon::parse($request->date)->diffInDays($fromDate);
            $lastWeekRequestCounts[$dateIndex] = $request->counts;
        }

        // entry activities last 31 days
        $last31DaysEntryActionCounts = [];
        $fromDate = Carbon::today()->subDay(31);
        $toDate = Carbon::today()->addDay();
        // $last31DaysEntryActions = Useraction::whereBetween('created_at', [$fromDate, $toDate])
        //     ->where('assigntype', 2)        // entry
        //     ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as counts'))
        //     ->groupBy('date')
        //     ->get();
        // foreach ($last31DaysEntryActions as $useraction) {
        //     $dateIndex = $toDate->diffInDays(Carbon::parse($useraction->date));
        //     $last31DaysEntryActionCounts[$dateIndex] = $useraction->counts;
        // }
        $last31DaysEntryActions = DB::select( DB::raw("
            select count(0) AS `count(*)`,cast(`useractions`.`created_at` as date) AS `date` from `useractions` where ((`useractions`.`created_at` between (curdate() - interval 31 day) and (curdate() + interval 1 day)) and (`useractions`.`assigntype` = 2)) group by cast(`useractions`.`created_at` as date)
        "));
        foreach ($last31DaysEntryActions as $useraction) {
            $dateIndex = $toDate->diffInDays(Carbon::parse($useraction->date));
            $last31DaysEntryActionCounts[$dateIndex] = $useraction->{"count(*)"};
        }

        // visa activities last 31 days
        $last31DaysVisaActionCounts = [];
        $fromDate = Carbon::today()->subDay(31);
        $toDate = Carbon::today()->addDay();
        // $last31DaysVisaActions = Useraction::whereBetween('created_at', [$fromDate, $toDate])
        //     ->where('assigntype', 12)       // visa
        //     ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as counts'))
        //     ->groupBy('date')
        //     ->get();
        // foreach ($last31DaysVisaActions as $useraction) {
        //     $dateIndex = $toDate->diffInDays(Carbon::parse($useraction->date));
        //     $last31DaysVisaActionCounts[$dateIndex] = $useraction->counts;
        // }
        $last31DaysVisaActions = DB::select( DB::raw("
            select count(0) AS `count(*)`,cast(`useractions`.`created_at` as date) AS `date` from `useractions` where ((`useractions`.`created_at` between (curdate() - interval 31 day) and (curdate() + interval 1 day)) and (`useractions`.`assigntype` = 12)) group by cast(`useractions`.`created_at` as date)
        "));
        foreach ($last31DaysVisaActions as $useraction) {
            $dateIndex = $toDate->diffInDays(Carbon::parse($useraction->date));
            $last31DaysVisaActionCounts[$dateIndex] = $useraction->{"count(*)"};
        }

        // corona activities last 31 days
        $last31DaysCoronaActionCounts = [];
        $fromDate = Carbon::today()->subDay(31);
        $toDate = Carbon::today()->addDay();
        $last31DaysCoronaActions = DB::select( DB::raw("
            select count(0) AS `count(*)`,cast(`useractions`.`created_at` as date) AS `date` from `useractions` where ((`useractions`.`created_at` between (curdate() - interval 31 day) and (curdate() + interval 1 day)) and (`useractions`.`assigntype` = 36)) group by cast(`useractions`.`created_at` as date)
        "));
        foreach ($last31DaysCoronaActions as $useraction) {
            $dateIndex = $toDate->diffInDays(Carbon::parse($useraction->date));
            $last31DaysCoronaActionCounts[$dateIndex] = $useraction->{"count(*)"};
        }

        // infosystem activities last 31 days
        $last31DaysInfosystemActionCounts = [];
        $toDate = Carbon::today()->addDay();
        $last31DaysInfosystemActions = DB::select( DB::raw("
            select count(0) AS `count(*)`,cast(`useractions`.`created_at` as date) AS `date` from `useractions` where ((`useractions`.`created_at` between (curdate() - interval 31 day) and (curdate() + interval 1 day)) and (`useractions`.`assigntype` = 7)) group by cast(`useractions`.`created_at` as date)
        "));
        foreach ($last31DaysInfosystemActions as $useraction) {
            $dateIndex = $toDate->diffInDays(Carbon::parse($useraction->date));
            $last31DaysInfosystemActionCounts[$dateIndex] = $useraction->{"count(*)"};
        }

        // infosystem2 activities last 31 days
        $last31DaysInfosystem2ActionCounts = [];
        $fromDate = Carbon::today()->subDay(31);
        $toDate = Carbon::today()->addDay();
        $last31DaysInfosystem2Actions = DB::select( DB::raw("
            select count(0) AS `count(*)`,cast(`useractions`.`created_at` as date) AS `date` from `useractions` where ((`useractions`.`created_at` between (curdate() - interval 31 day) and (curdate() + interval 1 day)) and (`useractions`.`assigntype` = 35)) group by cast(`useractions`.`created_at` as date)
        "));
        foreach ($last31DaysInfosystem2Actions as $useraction) {
            $dateIndex = $toDate->diffInDays(Carbon::parse($useraction->date));
            $last31DaysInfosystem2ActionCounts[$dateIndex] = $useraction->{"count(*)"};
        }

        // user activities this week
        $fromDate = Carbon::today()->startOfWeek();
        $toDate = Carbon::today()->endOfWeek()->addDay();
        $thisWeekTopFiveUsersByActionCount = Useraction::whereBetween('created_at', [$fromDate, $toDate])
            ->select(DB::raw('created_user, count(*) actionCount'))
            ->groupBy('created_user')
            ->orderBy('actionCount', 'desc')
            ->take(5)
            ->get();

        // user activities last week
        $fromDate = Carbon::today()->startOfWeek()->subWeek();
        $toDate = Carbon::today()->endOfWeek()->addDay()->subWeek();
        $lastWeekTopFiveUsersByActionCount = Useraction::whereBetween('created_at', [$fromDate, $toDate])
            ->select(DB::raw('created_user, count(*) actionCount'))
            ->groupBy('created_user')
            ->orderBy('actionCount', 'desc')
            ->take(5)
            ->get();

        $last31Days = $this->lastDays(31);

        // this shows the ammount of requests of the last 31 days grouped by day
        $requestsLast31Days = DB::connection('mysql2')->table('requests_last_31_days')->get();
        $requestsLast31Days = $this->createActionsArr($requestsLast31Days, $last31Days);

        // this shows the ammount of client actions of the last 31 days grouped by day
        $actionsClientLast31Days = DB::table('actions_client_last_31_days')->get();
        $actionsClientLast31Days = $this->createActionsArr($actionsClientLast31Days, $last31Days);

        // this shows the ammount of cruise actions of the last 31 days grouped by day
        $actionsCruiseLast31Days = DB::table('actions_cruise_last_31_days')->get();
        $actionsCruiseLast31Days = $this->createActionsArr($actionsCruiseLast31Days, $last31Days);

        // this shows the ammount of entry actions of the last 31 days grouped by day
        $actionsEntryLast31Days = DB::table('actions_entry_last_31_days')->get();
        $actionsEntryLast31Days = $this->createActionsArr($actionsEntryLast31Days, $last31Days);

        // this shows the ammount of health actions of the last 31 days grouped by day
        $actionsHealthLast31Days = DB::table('actions_health_last_31_days')->get();
        $actionsHealthLast31Days = $this->createActionsArr($actionsHealthLast31Days, $last31Days);

        // this shows the ammount of infosystem actions of the last 31 days grouped by day
        $actionsInfosystemLast31Days = DB::table('actions_infosystem_last_31_days')->get();
        $actionsInfosystemLast31Days = $this->createActionsArr($actionsInfosystemLast31Days, $last31Days);

        // this shows the ammount of transitvisa actions of the last 31 days grouped by day
        $actionsTransitvisaLast31Days = DB::table('actions_transitvisa_last_31_days')->get();
        $actionsTransitvisaLast31Days = $this->createActionsArr($actionsTransitvisaLast31Days, $last31Days);

        // this shows the ammount of visa actions of the last 31 days grouped by day
        $actionsVisaLast31Days = DB::table('actions_visa_last_31_days')->get();
        $actionsVisaLast31Days = $this->createActionsArr($actionsVisaLast31Days, $last31Days);

        // infosystem2 actions of the last 31 days grouped by day
        $actionsInfosystem2Last31Days = DB::table('actions_infosystem_last_31_days')->get();
        $actionsInfosystem2Last31Days = $this->createActionsArr($actionsInfosystem2Last31Days, $last31Days);

        // corona actions of the last 31 days grouped by day
        $actionsCoronaLast31Days = DB::table('actions_infosystem_last_31_days')->get();
        $actionsCoronaLast31Days = $this->createActionsArr($actionsCoronaLast31Days, $last31Days);

        return view('dashboard', compact(
            'thisWeekActionCounts', 'lastWeekActionCounts',
            'thisWeekRequestCounts', 'lastWeekRequestCounts',
            'last31DaysEntryActionCounts',
            'last31DaysVisaActionCounts',
            'last31DaysCoronaActionCounts',
            'last31DaysInfosystemActionCounts',
            'last31DaysInfosystem2ActionCounts',
            'thisWeekTopFiveUsersByActionCount',
            'lastWeekTopFiveUsersByActionCount',
            'last31Days',
            'requestsLast31Days',
            'actionsClientLast31Days',
            'actionsCruiseLast31Days',
            'actionsEntryLast31Days',
            'actionsHealthLast31Days',
            'actionsInfosystemLast31Days',
            'actionsTransitvisaLast31Days',
            'actionsVisaLast31Days',
            'actionsInfosystemLast31Days',
            'actionsInfosystem2Last31Days',
            'actionsCoronaLast31Days'
        ));
    }

    public function lastDays($days)
    {
        $date = Carbon::now()->subDays($days);
        while ($days --) {
            $date->addDay();
            $lastDays[] = $date->format('Y-m-d');
        }
        return $lastDays;
    }

    public function createActionsArr($records, $days)
    {
        $actionsArr = [];
        foreach ($days as $day) {
            $actionsArr[$day] = 0;
        }
        if (count($records) > 0) {
            foreach($records as $key => $value) {
                $actionsArr[$value->created] = $value->requests;
            }
        }
        return $actionsArr;
    }

}
