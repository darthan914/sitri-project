<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateScheduleClassDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->unsignedInteger('schedule_id')->nullable()->change();
            $table->integer('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_trial')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->unsignedInteger('schedule_id')->nullable()->change();
            $table->dropColumn('day');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('is_trial');
        });
    }
}
