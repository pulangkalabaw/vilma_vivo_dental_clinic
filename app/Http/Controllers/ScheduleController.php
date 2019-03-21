<?php

namespace App\Http\Controllers;

use Validator;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Schedule;
use App\Schedule_Notification;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedules = new Schedule();
        if(!empty($request->schedule_id)){
            $get_notification = Schedule_Notification::where('id', $request->schedule_id)->first();
            if(!empty($get_notification)){
                $schedules = Schedule::whereIn('id', $get_notification->schedule_id);
                $get_notification->update(['read_at'=> 1]);
            }
        }

        // return $request->all();

        if(!empty($request->get('sort_in') && !empty($request->get('sort_by')))) $schedules = Schedule::sort($request);

        if(!empty($request->search_string)) $schedules = Schedule::search(trim($request->search_string));

        $total = $schedules->count();

        $total_schedule = Schedule::count();

        $total_schedule_today = Schedule::whereDate('date', Carbon::now()->toDateString())->count();

        $schedules = $schedules->orderBy('id', 'desc')->paginate((!empty($request->show) ? $request->show : 10));
		return view('pages.scheduling.index', [
            'schedules' => $schedules,
            'total_schedule' => $total_schedule,
            'total' => $total,
            'total_today' => $total_schedule_today,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $total_schedule_today = Schedule::whereDate('date', Carbon::now()->toDateString())->count();
		return view('pages.scheduling.create', ['total_today' => $total_schedule_today]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
		$v = Validator::make($request->all(), [
            'tracking_no' => 'required',
			'name' => 'required|string|max:255',
			'contact' => 'required',
			'address' => 'required|string|max:255',
			'date' => 'required',
			'time' => 'required',
		]);

		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        $time = Carbon::parse($request->time)->toTimeString();

        // CHECK IF TIME IS ALREADY PASSED THE CURRENT TIME
        $time_now = Carbon::now()->toTimeString();
        if($time <= $time_now){
			return back()->withInput()->with([
				'notif.style' => 'danger',
				'notif.icon' => 'times-circle',
				'notif.message' => "The selected time is already passed.",
			]);
        }

        // CHECK IF TIME DOES'T HAVE A CONFLICT
        $date = Carbon::parse($request->date)->toDateString();
        $schedules = Schedule::whereDate('date', $date)->get();
        foreach($schedules as $schedule){
            $schedule_time = Carbon::parse($request->time)->toTimeString();
            $one_hour_before = Carbon::parse($request->time)->subHour(1)->toTimeString();
            $one_hour_after = Carbon::parse($request->time)->addHour(1)->toTimeString();
            if($time >= $one_hour_before || $time <= $one_hour_after){
    			return back()->withInput()->with([
    				'notif.style' => 'danger',
    				'notif.icon' => 'times-circle',
    				'notif.message' => 'Invalid Time! There is an existing schedule on '. $schedule_time . '. Make sure the time is before 1 hour or after 1 hour of the current schedule',
    			]);
            }
            return $schedule->time;
        }

        if (Schedule::create($request->except(['_token']))) {
			return back()->with([
				'notif.style' => 'success',
				'notif.icon' => 'plus-circle',
				'notif.message' => 'Added successful!',
			]);
		}
		else {
			return back()->withInput()->with([
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

    public function checkScheduleDate(Request $request){
        // return $request->all();

        // CHECK IF FETCHED DATA IS REAL DATE
        // return DateTime::createFromFormat('Y-m-d H:i:s', $request->date);
        // dd(DateTime::createFromFormat('Y-m-d', $request->date));
        if(DateTime::createFromFormat('Y-m-d', $request->date) !== FALSE){
            return Schedule::whereDate('date', $request->date)->count();
        }
    }
}
