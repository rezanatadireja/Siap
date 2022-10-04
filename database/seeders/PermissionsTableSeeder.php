<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['label' => 'List User', 'name' => 'user.index'],
            ['label' => 'Create User', 'name' => 'user.create'],
            ['label' => 'Store User', 'name' => 'user.store'],
            ['label' => 'View User', 'name' => 'user.show'],
            ['label' => 'Delete User', 'name' => 'user.destroy'],
            ['label' => 'Update User', 'name' => 'user.update'],
            ['label' => 'Edit User', 'name' => 'user.edit'],

            ['label' => 'List Settings', 'name' => 'setting.index'],
            ['label' => 'Create Settings', 'name' => 'setting.create'],
            ['label' => 'Store Settings', 'name' => 'setting.store'],
            ['label' => 'View Settings', 'name' => 'setting.show'],
            ['label' => 'Delete Settings', 'name' => 'setting.destroy'],
            ['label' => 'Update Settings', 'name' => 'setting.update'],
            ['label' => 'Edit Settings', 'name' => 'setting.edit'],

            ['label' => 'List Permissions', 'name' => 'permissions.list'],
            ['label' => 'Assign Roles', 'name' => 'assign.roles'],
            ['label' => 'Create Roles', 'name' => 'role.create'],
            ['label' => 'Create Permission Role', 'name' => 'permissionrole.create'],
            ['label' => 'Create Permissions', 'name' => 'permissions.create'],
        ];
        
        $warga = Role::create(['name' => 'warga']);

        $existPermission = Permission::pluck('name');
        foreach ($permissions as $value) {
            if (!in_array($value['name'], $existPermission->toArray())) {
                Permission::create([
                    'label' => $value['label'],
                    'name' => $value['name']
                ]);
            }
        }
        if (!$role = Role::where('name', 'admin')->first()) {
            echo "Creating Admin Role";
            $role = Role::create(['name' => 'admin']);
        }
        // $user = User::where('email', 'admin@gmail.com')->first();
        $user = User::whereEmailAndUsername('admin@gmail.com', 'administrator')->first();

        if (!$hasrole = $user->hasRole('admin')) {
            $user->assignRole('admin');
        }
        foreach ($permissions as $value) {
            if (!$permissionexist = $role->hasPermissionTo($value['name'])) {
                $role->givePermissionTo($value['name']);
            }
        }
    }
}
