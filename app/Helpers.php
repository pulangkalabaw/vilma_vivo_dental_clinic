<?php
function getNotification(){
    $schedule_notification = App\Schedule_Notification::whereDate('created_at', Carbon\Carbon::now()->toDateString())->get();
    return $schedule_notification;
}

function getUnreadNotification(){
    $schedule_notification = App\Schedule_Notification::where('read_at', 0)->whereDate('created_at', Carbon\Carbon::now()->toDateString())->get();
    return $schedule_notification;
}

function getReadNotification(){
    $schedule_notification = App\Schedule_Notification::where('read_at', 1)->whereDate('created_at', Carbon\Carbon::now()->toDateString())->get();
    return $schedule_notification;
}


?>
