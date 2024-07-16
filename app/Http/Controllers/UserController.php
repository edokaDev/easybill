<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(UserResource::collection($users), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create($validatedData);
            return response()->json(new UserResource($user), 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $th) {
            return response()->json(['error' => 'Error creating user'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string'
        ]);
        try {
            $user->update($validatedData);

            return response()->json(new UserResource($user), 200);
        } catch (Throwable $th) {
            return response()->json(['msg' => 'Error updating user', 'error' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    /**
     * Get the transactions of the specified user.
     */
    public function getTransactions(User $user)
    {
        $user->load('transactions');
        return TransactionResource::collection($user->transactions);
    }
}
