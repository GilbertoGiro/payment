<?php

namespace App\Repository;

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
