<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Repository\PermissionRepository;

class PermissionTableSeeder extends Seeder
{
    /**
     * Variable who contains permission repository
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * PermissionTableSeeder constructor.
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // Define permissions
        $permissions = [
            [
                'name' => Permission::PERMISSION_RECEIVE,
                'description' => 'Permissão para receber transferências',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => Permission::PERMISSION_TRANSFER,
                'description' => 'Permissão para transferir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        // Find or create it
        foreach ($permissions as $permission) {
            $this->permissionRepository->updateOrCreate(
                ['name' => $permission['name']], $permission
            );
        }
    }
}
