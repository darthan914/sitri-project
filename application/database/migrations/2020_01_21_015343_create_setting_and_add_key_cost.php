<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingAndAddKeyCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $value = [
            'register'    => 0,
            'one_month'   => 0,
            'three_month' => 0,
            'day_off'     => 0
        ];

        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary()->index()->unique();
            $table->text('value');
        });

        DB::statement('INSERT INTO `settings` (`key`, `value`) VALUES (\'cost\', \'' . json_encode($value) . '\')');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
