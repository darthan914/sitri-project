<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'day'        => 2,
                'start_time' => '14:00',
                'end_time'   => '16:00',
                'active'     => 1,
            ],
            [
                'day'        => 2,
                'start_time' => '16:00',
                'end_time'   => '18:00',
                'active'     => 1,
            ],
            [
                'day'        => 3,
                'start_time' => '14:00',
                'end_time'   => '16:00',
                'active'     => 1,
            ],
            [
                'day'        => 3,
                'start_time' => '16:00',
                'end_time'   => '18:00',
                'active'     => 1,
            ],
            [
                'day'        => 4,
                'start_time' => '14:00',
                'end_time'   => '16:00',
                'active'     => 1,
            ],
            [
                'day'        => 4,
                'start_time' => '16:00',
                'end_time'   => '18:00',
                'active'     => 1,
            ],
            [
                'day'        => 5,
                'start_time' => '14:00',
                'end_time'   => '16:00',
                'active'     => 1,
            ],
            [
                'day'        => 5,
                'start_time' => '16:00',
                'end_time'   => '18:00',
                'active'     => 1,
            ],
            [
                'day'        => 6,
                'start_time' => '10:00',
                'end_time'   => '12:00',
                'active'     => 1,
            ],
            [
                'day'        => 6,
                'start_time' => '12:30',
                'end_time'   => '14:30',
                'active'     => 1,
            ],
            [
                'day'        => 6,
                'start_time' => '15:00',
                'end_time'   => '17:00',
                'active'     => 1,
            ],
        ];

        DB::table('schedules')->insert($values);
    }
}
