<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /**
     * Database table columns
     * @var string[]
     */
    protected $fillable = [
        'transaction_type_id', 'user_id', 'amount', 'date'
    ];

    /**
     * Method to get related transaction type
     * @return HasOne
     */
    public function transactionType(): HasOne
    {
        return $this->hasOne(TransactionType::class, 'id', 'transaction_type_id');
    }

    /**
     * Method to get related user
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
