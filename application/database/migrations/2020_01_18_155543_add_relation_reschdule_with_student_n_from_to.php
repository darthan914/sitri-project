<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationReschduleWithStudentNFromTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $studentIdExists = DB::table('students')->pluck('id');
        $classScheduleIdExists = DB::table('class_schedules')->pluck('id');

        DB::table('reschedules')->whereNotIn('student_id', $studentIdExists)->delete();
        DB::table('reschedules')->whereNotIn('from_class_schedule_id', $classScheduleIdExists)->delete();
        DB::table('reschedules')->whereNotIn('to_class_schedule_id', $classScheduleIdExists)->delete();

        Schema::table('reschedules', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->change();
            $table->unsignedInteger('from_class_schedule_id')->change();
            $table->unsignedInteger('to_class_schedule_id')->change();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade')
            ;

            $table->foreign('from_class_schedule_id')
                  ->references('id')->on('class_schedules')
                  ->onDelete('cascade')
            ;

            $table->foreign('to_class_schedule_id')
                  ->references('id')->on('class_schedules')
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
        Schema::table('reschedules', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['from_class_schedule_id']);
            $table->dropForeign(['to_class_schedule_id']);
        });
    }
}
