<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_trials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('child_trials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_trial_id');
            $table->unsignedInteger('class_schedule_id');
            $table->string('name');
            $table->string('school')->nullable();
            $table->integer('age')->nullable();
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
        Schema::dropIfExists('parent_trials');
        Schema::dropIfExists('child_trials');
    }
}
