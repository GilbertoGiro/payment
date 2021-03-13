<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
         $this->call([
             RoleTableSeeder::class,
             PermissionTableSeeder::class,
             TransactionTypeTableSeeder::class,
             RolePermissionTableSeeder::class,
             AccountTableSeeder::class,
             ParameterTableSeeder::class
         ]);
    }
}
