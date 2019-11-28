<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->double('registration_value')->default(0);
            $table->double('monthly_value')->default(0);
            $table->double('day_off_value')->default(0);
            $table->double('shopping_value')->default(0);
            $table->string('type_payment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->double('value');
            $table->dropColumn('registration_value');
            $table->dropColumn('monthly_value');
            $table->dropColumn('day_off_value');
            $table->dropColumn('shopping_value');
            $table->dropColumn('type_payment');
        });
    }
}
