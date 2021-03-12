<?php

namespace App\Repositories;

use App\Models\RolePermission;

class RolePermissionRepository extends AbstractRepository
{
    /**
     * RolePermissionRepository constructor.
     * @param RolePermission $model
     */
    public function __construct(RolePermission $model)
    {
        parent::__construct($model);
    }
}
