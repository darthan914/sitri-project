<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationStudentWithUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userIdExists = DB::table('users')->pluck('id');

        DB::table('students')->whereNotIn('user_id', $userIdExists)->delete();

        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();

            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
