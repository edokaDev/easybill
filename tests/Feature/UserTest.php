<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllUsers()
    {
        $response = $this->get(route('users.index'));
        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
            ],
        ]);
    }

    public function testCreateUser()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('users.store'), $data);
        $response->assertCreated();
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
        ]);
    }

    public function testGetAUser()
    {
        $user = User::factory()->create();
        $response = $this->get(route('users.show', $user));
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
        ]);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->put(route('users.update', $user), $data);

        $response->assertOk();
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertNoContent();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
