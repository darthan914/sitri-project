<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitUserMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert("INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `active`) VALUES ('1', '1', 'Admin', 'admin@admin.com', '2019-09-01 00:00:00', '" . bcrypt('admin') . "', '1');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('delete from users where id = 1');
    }
}
