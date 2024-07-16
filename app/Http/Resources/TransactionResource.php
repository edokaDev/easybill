<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'description' => $this->description,
            'amount' => $this->amount,
            'charges' => $this->fees,
            'status' => $this->status,
            'transaction_type' => $this->transaction_type,
            'created_at' => $this->created_at
        ];
    }
}
