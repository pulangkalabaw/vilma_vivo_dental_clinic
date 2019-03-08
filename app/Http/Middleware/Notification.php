<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Schedule;
use App\Schedule_Notification;
use App\User;

class Notification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tomorrow = Carbon::now()->addDay(1)->toDateString();
        // dd(Carbon::now()->setTimeZone('Asia/Manila')->setTimeZone('Asia/Manila'));
        // dd($tomorrow);
        $today = Carbon::now()->setTimeZone('Asia/Manila')->toDateString();

        // CHECK DATE TOMORROW
        $schedule_tomorrow = Schedule::whereDate('date', $tomorrow)->get();
        $message_tomorrow = "You have " . count($schedule_tomorrow) . " scheduled patients tomorrow.";
        // dd(count($schedule_tomorrow));
        $schedule_tomorrow_id = [];
        if(count($schedule_tomorrow) == 1){
            // dd($schedule_tomorrow_id = [$schedule_tomorrow[0]->id]);
            $schedule_tomorrow_id[] = $schedule_tomorrow[0]->id;
            $patient_name = $schedule_tomorrow[0]->name;
            $message_tomorrow = $patient_name . " have a scheduled tomorrow at " . date('h:i A', strtotime($schedule_tomorrow[0]->time)) . ".";
        }
        else if(count($schedule_tomorrow) >= 1) {
            foreach($schedule_tomorrow as $tomorrow){
                $schedule_tomorrow_id[] = $tomorrow->id;
            }
        }
        // dd($message_tomorrow);
        // dd($schedule_tomorrow_id);
        // return
        $check_tomorrow_notifcation = Schedule_Notification::where('status', 0)->where('schedule_id', json_encode($schedule_tomorrow_id))->whereDate('created_at', Carbon::now()->setTimeZone('Asia/Manila')->toDateString())->first();
        // dd($check_tomorrow_notifcation);s
        if(empty($check_tomorrow_notifcation)){
            if(count($schedule_tomorrow) != 0){

                foreach(User::get() as $user){
                    Schedule_Notification::create([
                        'schedule_id' => $schedule_tomorrow_id,
                        'message' => $message_tomorrow,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
        // dd($schedule_tomorrow

    // );
        // CHECK DATE NOW
        $time_today = Carbon::now()->setTimeZone('Asia/Manila')->ToTimeString();
        // dd(Carbon::now()->setTimeZone('Asia/Manila')->ToTimeString());
        $schedule_today = Schedule::whereDate('date', $today)->whereTime('time', '>', $time_today)->get();
        // dd($schedule_today);
        $message_today = "You have " . count($schedule_today) . " scheduled patients today.";
        // dd(count($schedule_today));
        $schedule_today_id = [];
        if(count($schedule_today) == 1){
            $schedule_today_id[] = $schedule_today[0]->id;
            $patient_name = $schedule_today[0]->name;
            $message_today = $patient_name . " have a schedule today at " . date('h:i A', strtotime($schedule_today[0]->time)) . ".";
        }
        else if(count($schedule_today) >= 1) {
            foreach($schedule_today as $tomorrow){
                $schedule_today_id[] = $tomorrow->id;
            }
        }
        // dd($schedule_today_id);
        // dd($message_today);
        $check_today_notifcation = Schedule_Notification::where('status', 1)->where('schedule_id', json_encode($schedule_today_id))->whereDate('created_at', Carbon::now()->setTimeZone('Asia/Manila')->toDateString())->first();
        // dd($check_today_notifcation);
        if(empty($check_today_notifcation)){
            // if(count($schedule_today) != 0 || count($schedule_today) >= 0){
                foreach(User::get() as $user){
                    Schedule_Notification::create([
                        'schedule_id' => $schedule_today_id,
                        'message' => $message_today,
                        'status' => 1,
                        'user_id' => $user->id,
                    ]);
                }
            // }
        }


        return $next($request); //<-- this line :)
        // dd($tomorrow);
    }
}
