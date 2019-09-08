<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            StudentTableSeeder::class,
            ScheduleTableSeeder::class,
            ClassTableSeeder::class,
            ClassScheduleTableSeeder::class,
            ClassStudentTableSeeder::class,
        ]);
    }
}
