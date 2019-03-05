<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();
		return view('pages.scheduling.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('pages.scheduling.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$v = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'contact' => 'required',
			'address' => 'required|string|max:255',
			'date' => 'required',
			'time' => 'required',
		]);

		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        if (Schedule::insert($request->except(['_token']))) {
			return back()->with([
				'notif.style' => 'success',
				'notif.icon' => 'plus-circle',
				'notif.message' => 'Added successful!',
			]);
		}
		else {
			return back()->with([
				'notif.style' => 'danger',
				'notif.icon' => 'times-circle',
				'notif.message' => 'Failed to add',
			]);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::where('id', $id)->first();
		return view('pages.scheduling.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
		$v = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'date' => 'required',
			'time' => 'required',
		]);

		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        if (Schedule::where('id', $id)->update($request->except(['_token', '_method']))) {
			return back()->with([
				'notif.style' => 'success',
				'notif.icon' => 'plus-circle',
				'notif.message' => 'Updated successful!',
			]);
		}
		else {
			return back()->with([
				'notif.style' => 'danger',
				'notif.icon' => 'times-circle',
				'notif.message' => 'Failed to add',
			]);
		}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        if (Schedule::findOrFail($id)->delete()) {
            return back()->with([
                'notif.style' => 'success',
                'notif.icon' => 'plus-circle',
                'notif.message' => 'Delete successful',
            ]);
        }
        else {
            return back()->with([
                'notif.style' => 'danger',
                'notif.icon' => 'times-circle',
                'notif.message' => 'Failed to delete - Please try again',
            ]);
        }
    }
}
