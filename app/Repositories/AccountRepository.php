<?php

namespace App\Repositories;

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

    /**
     * Method to get all model rows count
     * @return int
     */
    public function allRowsCount(): int
    {
        return $this->model->all()->count();
    }
}
