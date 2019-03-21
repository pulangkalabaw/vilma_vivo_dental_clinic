<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tooth_Activity extends Model
{
    protected $table = 'tooth_activities';
    protected $fillable = ['record_id', 'tooth', 'symptom', 'description'];

    public function record() {
        return $this->hasOne('\App\tooth_activities', 'id', 'record_id');
    }
}
