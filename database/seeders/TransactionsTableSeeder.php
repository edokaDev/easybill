<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Transaction::truncate();

        $faker = Faker\Factory::create();
        $userIds = User::all()->pluck('id')->toArray();

        for ($i=0; $i < 10; $i++) {
            $userId = $faker->randomElement($userIds);
            Transaction::create([
                'user_id' => $userId,
                'description' => $faker->sentence,
                'amount' => $faker->numberBetween($min = 500, $max = 10000),
                'fees' => $faker->numberBetween($min = 20, $max = 100),
                'status' => $faker->text,
                'transaction_type' => random_int(0, 1) ? 'credit' : 'debit',
                'payment_method' => 'card'
            ]);
        }
    }
}
