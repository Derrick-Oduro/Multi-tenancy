<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions (shared across all tenants)
        $permissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            'view tags',
            'create tags',
            'edit tags',
            'delete tags',
            'view subscribers',
            'delete subscribers',
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'manage tenants',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin'
    ]);
        $superAdmin->givePermissionTo(Permission::all());


        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            'view tags',
            'create tags',
            'edit tags',
            'delete tags',
            'view subscribers',
            'delete subscribers',
            'manage roles',
        ]);

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'view posts',
            'create posts',
            'edit posts',
            'publish posts',
            'view categories',
            'create categories',
            'edit categories',
            'view tags',
            'create tags',
            'edit tags',
            'view subscribers',
        ]);

        $author = Role::create(['name' => 'author']);
        $author->givePermissionTo([
            'view posts',
            'create posts',
            'edit posts',
            'view categories',
            'view tags',
        ]);

        $guest = Role::create(['name' => 'guest']);
        $guest->givePermissionTo([
            'view posts',
            'view categories',
        ]);
    }
}
