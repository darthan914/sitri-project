<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClassScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = DB::select('select * from class_rooms');
        $schedules = DB::select('select * from schedules');
        $faker = Faker::create('id_ID');

        $values = [];

        foreach ($schedules as $schedule) {
            foreach ($classes as $class) {
                $values[] = [
                    'class_room_id' => $class->id,
                    'schedule_id'   => $schedule->id,
                    'active'        => rand(1, 100) >= 25 ? 1 : 0,
                    'is_trial'      => rand(1, 100) >= 80 ? 1 : 0,
                    'teacher_name'      => $faker->firstName,
                ];
            }
        }

        DB::table('class_schedules')->insert($values);
    }
}
