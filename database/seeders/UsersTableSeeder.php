<?php

namespace Database\Seeders;

use App\Models\User;
use Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate();

        $faker = Faker\Factory::create();

        for ($i=0; $i < 3; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => $faker->password(),
            ]);
        }
    }
}
