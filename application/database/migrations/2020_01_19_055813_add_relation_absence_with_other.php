<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationAbsenceWithOther extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $classScheduleIdExists = DB::table('class_schedules')->pluck('id');

        DB::table('absences')->whereNotIn('class_schedule_id', $classScheduleIdExists)->delete();


        Schema::table('absences', function (Blueprint $table) {
            $table->unsignedInteger('class_schedule_id')->change();

            $table->foreign('class_schedule_id')
                  ->references('id')->on('class_schedules')
                  ->onDelete('cascade')
            ;
        });

        $absenceIdExists = DB::table('absences')->pluck('id');
        $studentIdExists = DB::table('students')->pluck('id');

        DB::table('absence_details')->whereNotIn('absence_id', $absenceIdExists)->delete();
        DB::table('absence_details')->whereNotIn('student_id', $studentIdExists)->delete();

        Schema::table('absence_details', function (Blueprint $table) {
            $table->unsignedInteger('absence_id')->change();
            $table->unsignedBigInteger('student_id')->change();

            $table->foreign('absence_id')
                  ->references('id')->on('absences')
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
        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['class_schedule_id']);
        });

        Schema::table('class_students', function (Blueprint $table) {
            $table->dropForeign(['absence_id']);
            $table->dropForeign(['student_id']);
        });
    }
}
