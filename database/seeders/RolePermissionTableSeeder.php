<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Repository\RoleRepository;
use App\Repository\PermissionRepository;
use App\Repository\RolePermissionRepository;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Variable who contains permission repository
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * Variable who contains role repository
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * Variable who contains role/permission repository
     * @var RolePermissionRepository
     */
    private $rolePermissionRepository;

    /**
     * RolePermissionTableSeeder constructor.
     * @param PermissionRepository $permissionRepository
     * @param RoleRepository $roleRepository
     * @param RolePermissionRepository $rolePermissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository,
                                RoleRepository $roleRepository,
                                RolePermissionRepository $rolePermissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // Truncate table before insert rows
        DB::table($this->rolePermissionRepository->getTable())->truncate();
        // Insert 'user' role/permission relation
        $this->insertUserPermissions([
            Permission::PERMISSION_TRANSFER, Permission::PERMISSION_RECEIVE
        ]);
        // Insert 'shopkeeper' role/permission relation
        $this->insertShopkeeperPermissions([
            Permission::PERMISSION_RECEIVE
        ]);
    }

    /**
     * Method to insert 'user' (Role) permissions
     * @param array $availablePermissions
     */
    private function insertUserPermissions(array $availablePermissions)
    {
        // Find role
        $roleUser = $this->roleRepository->findBy(['name' => Role::ROLE_USER]);
        // Insert role permissions
        $roleUser->rolePermission()->insert(
            $this->permissionRepository->getFormattedPermissionsForSeeder($roleUser->id, $availablePermissions)
        );
    }

    /**
     * Method to insert 'shopkeeper' (Role) permissions
     * @param array $availablePermissions
     */
    private function insertShopkeeperPermissions(array $availablePermissions)
    {
        // Find role
        $roleShopkeeper = $this->roleRepository->findBy(['name' => Role::ROLE_SHOPKEEPER]);
        // Insert role permissions
        $roleShopkeeper->rolePermission()->insert(
            $this->permissionRepository->getFormattedPermissionsForSeeder($roleShopkeeper->id, $availablePermissions)
        );
    }
}
