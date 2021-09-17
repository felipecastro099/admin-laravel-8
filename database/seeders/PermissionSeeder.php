<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Permissions
        $permissions = [
            // Dashboard
            ['name' => 'view_dashboard', 'details' => 'Dashboard [view]'],

            // Audit
            ['name' => 'view_audits', 'details' => 'Auditorias [view]'],

            // Settings
            ['name' => 'view_settings', 'details' => 'Configurações [view]'],
            ['name' => 'add_settings', 'details' => 'Configurações [add]'],
            ['name' => 'edit_settings', 'details' => 'Configurações [edit]'],
            ['name' => 'delete_settings', 'details' => 'Configurações [delete]'],

            // Permissions
            ['name' => 'view_permissions', 'details' => 'Permissões [view]'],
            ['name' => 'add_permissions', 'details' => 'Permissões [add]'],
            ['name' => 'edit_permissions', 'details' => 'Permissões [edit]'],
            ['name' => 'delete_permissions', 'details' => 'Permissões [delete]'],

            // Roles
            ['name' => 'view_roles', 'details' => 'Grupos [view]'],
            ['name' => 'add_roles', 'details' => 'Grupos [add]'],
            ['name' => 'edit_roles', 'details' => 'Grupos [edit]'],
            ['name' => 'delete_roles', 'details' => 'Grupos [delete]'],

            // Users
            ['name' => 'view_users', 'details' => 'Usuários [view]'],
            ['name' => 'add_users', 'details' => 'Usuários [add]'],
            ['name' => 'edit_users', 'details' => 'Usuários [edit]'],
            ['name' => 'delete_users', 'details' => 'Usuários [delete]'],

        ];

        foreach ($permissions as $permission) :
            Permission::create([
                'name' => $permission['name'],
                'details' => $permission['details'],
                'guard_name' => 'web'
            ]);
        endforeach;
    }
}
