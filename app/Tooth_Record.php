<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tooth_Record extends Model
{
    protected $table = "tooth_records";
    protected $fillable = ['record_id', 'tooth', 'symptom', 'description'];

    public function record() {
        return $this->hasOne('\App\Tooth_Record', 'id', 'record_id');
    }
}
