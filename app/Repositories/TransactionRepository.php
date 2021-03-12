<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository extends AbstractRepository
{
    /**
     * TransactionRepository constructor.
     * @param Transaction $model
     */
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }
}
