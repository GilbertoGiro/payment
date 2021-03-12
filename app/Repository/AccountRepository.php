<?php

namespace App\Repository;

use App\Models\Account;

class AccountRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }
}
