<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = "schedules";
    protected $fillabe = ['name', 'contact', 'address', 'date', 'time'];
}
