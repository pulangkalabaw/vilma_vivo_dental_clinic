<?php

namespace App;

use Schema;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = "records";
    protected $fillabe = ['name', 'contact', 'address'];

    public function tooth() {
        return $this->hasMany('\App\Tooth_Record', 'record_id', 'id');
    }

    public  function scopeSearch ($query, $value) {
        $val = trim($value);
        return $query->where('name', 'LIKE', "%".$val."%")
        ->orWhere('contact', 'LIKE', "%".$val."%")
        ->orWhere('address', 'LIKE', "%".$val."%");
    }

	public function scopeSort ($query, $request) {

        // Check first if sort_in (database column) is exists!
        if (!Schema::hasColumn('records', $request->get('sort_in'))) return $query;

        // If everything is good
        return $query->orderBy($request->get('sort_in'), $request->get('sort_by'));
    }
}
