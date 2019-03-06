<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = "records";
    protected $fillabe = ['name', 'contact', 'address'];

    public function tooth() {
        return $this->hasMany('\App\Tooth_Record', 'record_id', 'id');
    }
}
