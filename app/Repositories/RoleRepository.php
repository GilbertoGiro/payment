<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends AbstractRepository
{
    /**
     * RoleRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
