<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends AbstractRepository
{
    /**
     * PermissionRepository constructor.
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    /**
     * Method to get formatted permissions for insert in seeder
     * @param $roleId
     * @param $availablePermissions
     * @return array
     */
    public function getFormattedPermissionsForSeeder($roleId, $availablePermissions): array
    {
        return $this->model->all()->whereIn('name', $availablePermissions)->map(function ($permission) use ($roleId) {
            return [
                'role_id' => $roleId,
                'permission_id' => $permission->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        })->toArray();
    }
}
