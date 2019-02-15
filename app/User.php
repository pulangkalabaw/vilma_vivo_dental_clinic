<?php

namespace App;

use Schema;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


	public function scopeSort ($query, $request) {

        // Check first if sort_in (database column) is exists!
        if (!Schema::hasColumn('users', $request->get('sort_in'))) return $query;

        // If everything is good
        return $query->orderBy($request->get('sort_in'), $request->get('sort_by'));
    }


    public  function scopeSearch ($query, $value) {
        $val = trim($value);
        return $query->where('name', 'LIKE', "%".$val."%")
        ->orWhere('email', 'LIKE', "%".$val."%");
    }


}
