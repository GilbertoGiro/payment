<?php

namespace App\Repositories;

use App\Models\TransactionType;

class TransactionTypeRepository extends AbstractRepository
{
    /**
     * TransactionTypeRepository constructor.
     * @param TransactionType $model
     */
    public function __construct(TransactionType $model)
    {
        parent::__construct($model);
    }
}
