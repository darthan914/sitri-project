<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::select('select * from users');

        $faker = Faker::create('id_ID');
        $values = [];
        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($users as $user) {
            $rand_num_student = rand(0, 3);

            if ($rand_num_student > 1) {
                foreach (range(1, $rand_num_student) as $list) {
                    $values[] = [
                        'user_id'    => $user->id,
                        'name'       => $faker->firstName,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }


        DB::table('students')->insert($values);
    }
}
