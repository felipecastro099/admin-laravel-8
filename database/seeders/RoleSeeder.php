<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Root Role
        $root = Role::create([
            'name' => 'root',
            'details' => 'Root',
            'guard_name' => 'web'
        ]);

        $gestor = Role::create([
            'name' => 'gestor',
            'details' => 'Gestor',
            'guard_name' => 'web'
        ]);

        $root->syncPermissions(Permission::all());
        $gestor->syncPermissions(Permission::all());
    }
}
