<?php

namespace App;

use Schema;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table = "inventories";
	protected $fillable = [
		'item_id', 'item_name', 'quantity', 'item_date', 'description', 'added_by',
	];

	public function added()
	{
		return $this->hasOne('App\User', 'id', 'added_by');
	}

	public function history()
	{
		return $this->hasMany('App\InventoryHistory', 'inventory_id', 'id');
	}

	public function out()
	{
		return $this->hasMany('App\InventoryOut', 'inventory_id', 'id')->orderBy('id', 'desc');
	}

	public function in()
	{
		return $this->hasMany('App\InventoryIn', 'inventory_id', 'id')->orderBy('id', 'desc');
	}

	public function scopeSort ($query, $request) {

        // Check first if sort_in (database column) is exists!
        if (!Schema::hasColumn('inventories', $request->get('sort_in'))) return $query;

        // If everything is good
        return $query->orderBy($request->get('sort_in'), $request->get('sort_by'));
    }


    public  function scopeSearch ($query, $value) {
        $val = trim($value);
        return $query->where('item_id', 'LIKE', "%".$val."%")
        ->orWhere('item_name', 'LIKE', "%".$val."%")
        ->orWhere('quantity', 'LIKE', "%".$val."%")
        ->orWhere('item_date', 'LIKE', "%".$val."%")
        ->orWhere('description', 'LIKE', "%".$val."%");
    }

}
