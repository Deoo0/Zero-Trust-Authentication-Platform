<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        //Define permissions
        Permission::create(['name'=>'create post']);
        Permission::create(['name'=>'view post']);
        Permission::create(['name'=>'edit post']);
        Permission::create(['name'=>'create user']);
        Permission::create(['name'=>'edit user']);
        Permission::create(['name'=>'delete user']);

        //Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        //Assign Permission
        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo([['create post', 'view post', 'edit post']]);
    }
}
