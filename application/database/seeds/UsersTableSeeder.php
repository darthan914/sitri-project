<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $values = [];
        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach (range(1, 50) as $list) {
            $values[] = [
                'name'     => $faker->name,
                'email'    => $faker->safeEmail,
                'password' => bcrypt('secret'),
                'email_verified_at' => $now,
                'active' => rand(0, 1),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('users')->insert($values);
    }
}
