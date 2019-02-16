<?php

namespace App\Http\Controllers;

use App\User;
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

        return view('home', [
			'count_user_roles' => $count_user_roles,
			'inventory_count' => $inventory,
		]);
    }
}
