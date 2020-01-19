<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationClassStudentWithOther extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $classScheduleIdExists = DB::table('class_schedules')->pluck('id');
        $studentIdExists = DB::table('students')->pluck('id');

        DB::table('class_students')->whereNotIn('class_schedule_id', $classScheduleIdExists)->delete();
        DB::table('class_students')->whereNotIn('student_id', $studentIdExists)->delete();

        Schema::table('class_students', function (Blueprint $table) {
            $table->unsignedInteger('class_schedule_id')->change();
            $table->unsignedBigInteger('student_id')->change();

            $table->foreign('class_schedule_id')
                  ->references('id')->on('class_schedules')
                  ->onDelete('cascade')
            ;

            $table->foreign('student_id')
                  ->references('id')->on('students')
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
        Schema::table('class_students', function (Blueprint $table) {
            $table->dropForeign(['class_schedule_id']);
            $table->dropForeign(['student_id']);
        });
    }
}
