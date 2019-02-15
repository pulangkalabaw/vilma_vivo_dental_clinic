<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('inventories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('item_id');
			$table->string('item_name');
			$table->string('quantity');
			$table->string('item_date');
			$table->text('description');
			$table->integer('added_by')->unsigned();
			$table->timestamps();
		});


		Schema::table('inventories', function(Blueprint $table) {
			$table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('inventories');
	}
}
