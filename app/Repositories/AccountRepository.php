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

    /**
     * Method to increment given value from user account
     * @param int $userId
     * @param float $value
     */
    public function increment(int $userId, float $value)
    {
        $account = $this->findBy(['user_id' => $userId]);
        $account->lockForUpdate();
        $account->balance = bcadd($account->balance, $value, 2);
        $account->save();
    }

    /**
     * Method to decrement given value from user account
     * @param int $userId
     * @param float $value
     */
    public function decrement(int $userId, float $value)
    {
        $account = $this->findBy(['user_id' => $userId]);
        $account->lockForUpdate();
        $account->balance = bcsub($account->balance, $value, 2);
        $account->save();
    }
}
