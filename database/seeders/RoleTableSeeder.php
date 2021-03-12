<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Repository\RoleRepository;

class RoleTableSeeder extends Seeder
{
    /**
     * Variable who contains role repository
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RoleTableSeeder constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // Define roles
        $roles = [
            [
                'name' => Role::ROLE_USER,
                'description' => 'Usuário comum',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => Role::ROLE_SHOPKEEPER,
                'description' => 'Usuário Lojista',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        // Find or create it
        foreach ($roles as $role) {
            $this->roleRepository->updateOrCreate(
                ['name' => $role],
                $role
            );
        }
    }
}
