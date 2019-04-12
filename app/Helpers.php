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

function checkTreatment($treatment){
    if($treatment == 'root'){
        return 'Root Canal Treatment';
    } else if($treatment == 'cosmetic_dentistry'){
        return 'Cosmetic Dentistry';
    } else if($treatment == 'dental_crown'){
        return 'Dental Crown';
    } else if($treatment == 'tooth_whitening'){
        return 'Tooth Whitening';
    } else if($treatment == 'dental_implants'){
        return 'Dental Implants';
    } else if($treatment == 'dental_bridge'){
        return 'Dental Bridge';
    } else if($treatment == 'periodontics'){
        return 'Periodontics';
    } else if($treatment == 'orthodontics'){
        return 'Orthodontics';
    } else if($treatment == 'dentures'){
        return 'Dentures';
    } else if($treatment == 'maxillofacial'){
        return 'Maxillofacial Prosthesis';
    }
}

function treatmentList(){
    return [
        'root',
        'cosmetic_dentistry',
        'dental_crown',
        'tooth_whitening',
        'dental_implants',
        'dental_bridge',
        'periodontics',
        'orthodontics',
        'dentures',
        'maxillofacial',
    ];
}

?>
