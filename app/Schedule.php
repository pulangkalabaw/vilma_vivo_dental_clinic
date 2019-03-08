<?php

namespace App;

use Schema;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = "schedules";
    protected $fillabe = ['name', 'contact', 'address', 'date', 'time'];

    public function scopeSearch ($query, $value) {
        $val = trim($value);
        return $query->where('name', 'LIKE', "%".$val."%")
        ->orWhere('contact', 'LIKE', "%".$val."%")
        ->orWhere('address', 'LIKE', "%".$val."%");
    }

	public function scopeSort ($query, $request) {

        // Check first if sort_in (database column) is exists!
        if (!Schema::hasColumn('schedules', $request->get('sort_in'))) return $query;

        // If everything is good
        return $query->orderBy($request->get('sort_in'), $request->get('sort_by'));
    }
}
