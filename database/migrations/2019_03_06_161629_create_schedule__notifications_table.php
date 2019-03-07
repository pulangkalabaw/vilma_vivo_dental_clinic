<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_notifications', function (Blueprint $table) {
            $table->increments('id');
			$table->text('schedule_id');
			// $table->string('schedule_date');
			// $table->string('schedule_time');
			$table->string('status')->default(0);
			$table->string('message');
			$table->string('read_at')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule__notifications');
    }
}
