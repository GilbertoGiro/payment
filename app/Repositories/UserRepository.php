<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\Permission;

class UserRepository extends AbstractRepository
{
    use Permission;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
