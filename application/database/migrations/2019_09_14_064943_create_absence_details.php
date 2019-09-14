<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absence_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('absence_id');
            $table->unsignedInteger('student_id');
            $table->string('status')->comment('[PRESENT, ABSENCE, RESCHEDULE]');
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
        Schema::dropIfExists('absence_details');
    }
}
