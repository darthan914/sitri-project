<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationClassScheduleWithOther extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $classRoomIdExists = DB::table('class_rooms')->pluck('id');
        $scheduleIdExists = DB::table('schedules')->pluck('id');

        DB::table('class_schedules')->whereNotIn('class_room_id', $classRoomIdExists)->delete();
        DB::table('class_schedules')->whereNotIn('schedule_id', $scheduleIdExists)->delete();

        Schema::table('class_schedules', function (Blueprint $table) {
            $table->unsignedInteger('class_room_id')->change();
            $table->unsignedInteger('schedule_id')->change();

            $table->foreign('class_room_id')
                  ->references('id')->on('class_rooms')
                  ->onDelete('cascade')
            ;

            $table->foreign('schedule_id')
                  ->references('id')->on('schedules')
                  ->onDelete('cascade')
            ;
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
            $table->dropForeign(['class_room_id']);
            $table->dropForeign(['schedule_id']);
        });
    }
}
