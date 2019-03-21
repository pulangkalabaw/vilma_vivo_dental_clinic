<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Schedule;
use App\User;
use App\Record;
use App\Inventory;
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
    public function index()
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

        return view('home', [
			'count_user_roles' => $count_user_roles,
			'inventory_count' => $inventory,
			'sched_today' => $today_sched,
			'sched_pending' => $pending,
			'record_count' => $record_count,
		]);
    }
}
