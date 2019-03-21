<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryOut extends Model
{
	protected $table = "inventory_outs";
	protected $guarded = [];

	public function added()
	{
		return $this->hasOne('App\User', 'id', 'added_by');
	}

	public function inventory()
	{
		return $this->hasOne('App\Inventory', 'id', 'inventory_id');
	}
}
