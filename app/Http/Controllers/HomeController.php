<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Schedule;
use App\User;
use App\Record;
use App\Inventory;
use App\Tooth_Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$inventory = Inventory::count();

		$count_user_roles = User::groupBy('role')->get(['role'])->map(function($r) {
            $r['count'] = User::where('role', $r['role'])->count();
            $r['total'] = User::count();
            return $r;
        });


		// Scheduled today
		$today_sched = Schedule::whereDate('date', '=', Carbon::today()->toDateString())->count();
		$pending = Schedule::whereDate('date', '>=',  Carbon::today()->toDateString())->count();


		// Record
		$record_count = Record::count();

        // Record Summary
        $year = !empty($request->year) ? $request->year : Carbon::now()->year;
        // return Carbon::parse($request->month . ', ' . $year)->month;
        $month = !empty($request->month) ? Carbon::parse($request->month)->month : Carbon::now()->month;
        $history = Tooth_Activity::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        $list = treatmentList();

        foreach($list as $index => $treatment){
            $record_summary_count[$treatment] = 0;

            foreach($history as $his){
                $get_treatments = explode(",", $his['symptom']);

                foreach($get_treatments as $gtreatment){
                    $trimmed = trim($gtreatment);

                    if($trimmed == $treatment){
                        $record_summary_count[$treatment]++;
                    }
                }
            }
        }

        return view('home', [
			'count_user_roles' => $count_user_roles,
			'inventory_count' => $inventory,
			'sched_today' => $today_sched,
			'sched_pending' => $pending,
			'record_count' => $record_count,
			'record_summary' => $record_summary_count,
		]);
    }
}
