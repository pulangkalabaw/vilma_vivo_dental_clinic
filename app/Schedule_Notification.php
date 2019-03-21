<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule_Notification extends Model
{
    protected $table = "schedule_notifications";
    protected $fillable = ['schedule_id', 'status', 'schedule_date', 'schedule_time', 'message', 'user_id', 'read_at'];

    public function setScheduleIdAttribute($value)
    {
        $this->attributes['schedule_id'] = json_encode($value);
    }

    public function getScheduleIdAttribute($value)
    {
        return json_decode($value);
    }
}
