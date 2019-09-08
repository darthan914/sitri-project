<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classSchedules = DB::select('select * from class_schedules');
        $students = DB::select('select * from students');

        $students = collect($students)->map(function ($student) {return $student->id;});

        $values = [];

        foreach ($classSchedules as $classSchedule) {
            foreach (range(1, 5) as $student) {
                $values[] = [
                    'class_schedule_id' => $classSchedule->id,
                    'student_id'        => $students[rand(0, max(count($students) - 1, 0))],
                ];
            }
        }
        $values = array_unique($values, SORT_REGULAR);
        DB::table('class_students')->insert($values);
    }
}
