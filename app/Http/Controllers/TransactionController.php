<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return TransactionResource::collection($transactions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'description' => 'required|string',
                'amount' => 'required|numeric',
                'status' => 'required|string',
                'fees' => 'nullable|numeric',
                'transaction_type' => 'required|string',
                'payment_method' => 'required|string',
            ]);

            $transaction = Transaction::create($validatedData);
            return response()->json(new TransactionResource($transaction), 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $th) {
            return response()->json(['error' => 'Error creating transaction'], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'status' => 'nullable|string',
            'fees' => 'nullable|numeric',
            'transaction_type' => 'nullable|string',
            'payment_method' => 'nullable|string',
        ]);
        try {

            $transaction->update($validatedData);

            return response()->json(new TransactionResource($transaction), 200);
        } catch (Throwable $th) {
            return response()->json(['error' => 'Error updating transaction'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }
}
