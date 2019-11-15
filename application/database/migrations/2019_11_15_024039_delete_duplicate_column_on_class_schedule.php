<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteDuplicateColumnOnClassSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 1 WHERE `day` = 2 and `start_time` = '14:00:00' and `end_time` = '16:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 2 WHERE `day` = 2 and `start_time` = '16:00:00' and `end_time` = '18:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 3 WHERE `day` = 3 and `start_time` = '14:00:00' and `end_time` = '16:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 4 WHERE `day` = 3 and `start_time` = '16:00:00' and `end_time` = '18:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 5 WHERE `day` = 4 and `start_time` = '14:00:00' and `end_time` = '16:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 6 WHERE `day` = 4 and `start_time` = '16:00:00' and `end_time` = '18:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 7 WHERE `day` = 5 and `start_time` = '14:00:00' and `end_time` = '16:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 8 WHERE `day` = 5 and `start_time` = '16:00:00' and `end_time` = '18:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 9 WHERE `day` = 6 and `start_time` = '10:00:00' and `end_time` = '12:00:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 10 WHERE `day` = 6 and `start_time` = '12:30:00' and `end_time` = '14:30:00'");
        DB::statement("UPDATE `class_schedules` SET `schedule_id` = 11 WHERE `day` = 6 and `start_time` = '15:00:00' and `end_time` = '17:00:00'");
        DB::statement("DELETE FROM `class_schedules` WHERE `schedule_id` is null");

        Schema::table('class_schedules', function (Blueprint $table) {
            $table->unsignedInteger('schedule_id')->change();
            $table->dropColumn('day');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
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
            $table->integer('day');
            $table->time('start_time');
            $table->time('end_time');
        });
    }
}
