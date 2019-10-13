<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInformationStudentColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('surname')->nullable();
            $table->date('birthday')->nullable();
            $table->string('school')->nullable();
            $table->string('grade')->nullable();
            $table->text('address')->nullable();
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
            $table->dropColumn('surname');
            $table->dropColumn('birthday');
            $table->dropColumn('school');
            $table->dropColumn('grade');
            $table->dropColumn('address');
        });
    }
}
