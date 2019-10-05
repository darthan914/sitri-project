<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $values = [];

        foreach ($schedules as $schedule) {
            foreach ($classes as $class) {
                $values[] = [
                    'class_room_id' => $class->id,
                    'day'           => $schedule->day,
                    'start_time'    => $schedule->start_time,
                    'end_time'      => $schedule->end_time,
                    'active'        => rand(1, 100) >= 25 ? 1 : 0,
                    'is_trial'      => rand(1, 100) >= 80 ? 1 : 0,
                ];
            }
        }

        DB::table('class_schedules')->insert($values);
    }
}
