<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert("INSERT INTO `roles` (`id`, `name`, `can`, `active`) VALUES
(1, 'Master', '[\"confirm-user\",\"list-user\",\"create-user\",\"update-user\",\"delete-user\",\"list-role\",\"create-role\",\"update-role\",\"delete-role\",\"list-student\",\"create-student\",\"update-student\",\"delete-student\",\"list-schedule\",\"create-schedule\",\"update-schedule\",\"delete-schedule\",\"list-classRoom\",\"create-classRoom\",\"update-classRoom\",\"delete-classRoom\",\"list-classSchedule\",\"create-classSchedule\",\"update-classSchedule\",\"delete-classSchedule\",\"list-classStudent\",\"create-classStudent\",\"update-classStudent\",\"delete-classStudent\",\"list-reschedule\",\"create-reschedule\",\"update-reschedule\",\"delete-reschedule\",\"list-absence\",\"create-absence\",\"update-absence\",\"delete-absence\",\"list-payment\",\"create-payment\",\"update-payment\",\"delete-payment\"]', 1),
(2, 'Admin', '[\"confirm-user\",\"list-user\",\"create-user\",\"update-user\",\"delete-user\",\"list-student\",\"create-student\",\"update-student\",\"delete-student\",\"list-schedule\",\"create-schedule\",\"update-schedule\",\"delete-schedule\",\"list-classRoom\",\"create-classRoom\",\"update-classRoom\",\"delete-classRoom\",\"list-classSchedule\",\"create-classSchedule\",\"update-classSchedule\",\"delete-classSchedule\",\"list-classStudent\",\"create-classStudent\",\"update-classStudent\",\"delete-classStudent\",\"list-reschedule\",\"create-reschedule\",\"update-reschedule\",\"delete-reschedule\",\"list-absence\",\"create-absence\",\"update-absence\",\"delete-absence\",\"list-payment\",\"create-payment\",\"update-payment\",\"delete-payment\"]', 1),
(3, 'Parent', '[\"list-user\",\"update-user\",\"list-student\",\"create-student\",\"update-student\",\"list-classStudent\",\"list-reschedule\",\"create-reschedule\",\"update-reschedule\",\"delete-reschedule\",\"list-payment\"]', 1);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('delete from roles where id in (1, 2, 3)');
    }
}
