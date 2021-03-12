<?php

namespace App\Repository;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
