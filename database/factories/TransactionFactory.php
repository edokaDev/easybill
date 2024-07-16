<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */

 class TransactionFactory extends Factory
 {
     protected $model = Transaction::class;

     public function definition()
     {
        $user = User::factory()->create();
        return [

            'user_id' => $user->id,
            'description' => $this->faker->sentence,
            'amount' => $this->faker->numberBetween(100, 1000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'declined']),
            'fees' => $this->faker->numberBetween(10, 50),
            'transaction_type' => $this->faker->randomElement(['credit', 'debit']),
            'payment_method' => $this->faker->randomElement(['card', 'bank_transfer']),
        ];
    }
 }
