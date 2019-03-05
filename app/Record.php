<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = "records";
    protected $fillabe = ['name', 'contact', 'address', 'top_position', 'top_image', 'bottom_position', 'bottom_image'];
}
