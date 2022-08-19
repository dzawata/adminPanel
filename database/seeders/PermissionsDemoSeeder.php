<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\DB;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'list_users']);
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'edit_user']);
        Permission::create(['name' => 'delete_user']);
        Permission::create(['name' => 'list_roles']);
        Permission::create(['name' => 'create_role']);
        Permission::create(['name' => 'edit_role']);
        Permission::create(['name' => 'delete_role']);
        Permission::create(['name' => 'list_permissions']);
        Permission::create(['name' => 'create_permission']);
        Permission::create(['name' => 'delete_permission']);

        // create role
        $role = Role::create(['name' => 'super-admin']);

        // create user
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('123qweasd')
        ]);

        // asign role to user
        $user->assignRole($role);

        //create menu seeder
        DB::table('menus')->insertGetId([
            'parent_id' => 0,
            'name' => 'Dashboard',
            'url' => 'dashboard',
            'icon' => 'fa-tachometer-alt',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $id = DB::table('menus')->insertGetId([
            'parent_id' => 0,
            'name' => 'User Administration',
            'url' => '#',
            'icon' => 'fa-cog',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('menus')->insertGetId([
            'parent_id' => $id,
            'name' => 'Users',
            'url' => 'users',
            'icon' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('menus')->insertGetId([
            'parent_id' => $id,
            'name' => 'Roles',
            'url' => 'roles',
            'icon' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('menus')->insertGetId([
            'parent_id' => $id,
            'name' => 'Permissions',
            'url' => 'permissions',
            'icon' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('menus')->insertGetId([
            'parent_id' => 0,
            'name' => 'Menus',
            'url' => 'menus',
            'icon' => 'fa-link',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $id = DB::table('menus')->insertGetId([
            'parent_id' => 0,
            'name' => 'Settings',
            'url' => '#',
            'icon' => 'fa-cog',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('menus')->insertGetId([
            'parent_id' => $id,
            'name' => 'Remove Cache',
            'url' => 'remove-cache',
            'icon' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // run this command to migrate demo seeder 
        // php artisan migrate:fresh --seed --seeder=PermissionsDemoSeeder
    }
}
