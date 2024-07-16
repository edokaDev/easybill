<?php

namespace Tests\Feature;

use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllTransactions()
    {
        $transactions = Transaction::factory()->count(5)->create();
        $response = $this->get(route('transactions.index'));
        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'user_id',
                'description',
                'amount',
                'charges',
                'status',
                'transaction_type',
                'created_at'
                ]
        ]);
    }

    public function testCreateTransaction()
    {
        $user = User::factory()->create();
        $data = [
            'user_id' => $user->id,
            'description' => 'Test transaction',
            'amount' => 100,
            'status' => 'pending',
            'fees' => 10,
            'transaction_type' => 'credit',
            'payment_method' => 'card',
        ];

        $response = $this->post(route('transactions.store'), $data);
        $response->assertCreated();
        $response->assertJsonStructure([
            'id',
            'user_id',
            'description',
            'amount',
            'charges',
            'status',
            'transaction_type',
            'created_at'
    ]);
    }

    public function testGetATransaction()
    {
        $transaction = Transaction::factory()->create();
        $response = $this->get(route('transactions.show', $transaction));
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'user_id',
            'description',
            'amount',
            'charges',
            'status',
            'transaction_type',
            'created_at'
    ]);
    }

    public function testUpdateTransaction()
    {
        $transaction = Transaction::factory()->create();
        $data = [
            'description' => 'Updated transaction',
            'amount' => 200,
        ];

        $response = $this->put(route('transactions.update', $transaction), $data);
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'user_id',
            'description',
            'amount',
            'charges',
            'status',
            'transaction_type',
            'created_at'
    ]);
    }

    public function testDeleteTransaction()
    {
        $transaction = Transaction::factory()->create();
        $response = $this->delete(route('transactions.destroy', $transaction));
        $response->assertNoContent();
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }
}
