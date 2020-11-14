<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionItems extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
