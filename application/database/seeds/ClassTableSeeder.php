<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
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
                'name'   => 'A',
                'active' => 1,
            ],
            [
                'name'   => 'B',
                'active' => 1,
            ],
        ];

        DB::table('class_rooms')->insert($values);
    }
}
