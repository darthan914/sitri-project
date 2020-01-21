<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->boolean('use_registration');
            $table->boolean('use_monthly');
            $table->boolean('use_shopping');

            $table->renameColumn('registration_value', 'register_value');
            $table->renameColumn('type_payment', 'type_month_payment');

            $table->unsignedInteger('one_month_month')->nullable();
            $table->renameColumn('monthly_value', 'one_month_value');

            $table->string('three_month_month')->nullable();
            $table->double('three_month_value');

            $table->unsignedInteger('day_off_month')->nullable();


            $table->text('items')->nullable();

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
            $table->dropColumn('use_registration');
            $table->dropColumn('use_monthly');
            $table->dropColumn('use_shopping');

            $table->renameColumn('register_value', 'registration_value');
            $table->renameColumn('type_month_payment', 'type_payment');

            $table->dropColumn('one_month_month');
            $table->renameColumn('one_month_value', 'monthly_value');

            $table->dropColumn('three_month_month');
            $table->dropColumn('three_month_value');

            $table->dropColumn('day_off_month');

            $table->dropColumn('items');
        });
    }
}
