<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
                     'role-list',
                     'role-create',
                     'role-edit',
                     'role-delete',
                     'user-list',
                     'user-create',
                     'user-edit',
                     'user-delete',
                     'order-list',
                     'order-client-list',
                     'order-worker-list',
                     'order-create',
                     'order-edit',
                     'order-delete',
                     'service-create',
                     'service-edit',
                     'service-delete',
                     'worker-create',
                     'worker-edit',
                     'worker-delete',
                     'post-create',
                     'post-edit',
                     'post-delete',
                     'type-create',
                     'type-edit',
                     'type-delete',
                     'record-list',
                     'record-update',
                     'indication-create',
                     'indication-edit',
                     'indication-delete',
                     'contraindication-create',
                     'contraindication-edit',
                     'contraindication-delete',
                 ] as $permission) {
            Permission::create(['name' => $permission]);
        }
        $root = User::create([
            'name' => 'root',
            'password' => bcrypt('root')
        ]);
        $role = Role::create(['name' => 'Администратор']);
        $rolePermissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($rolePermissions);
        $root->assignRole([$role->id]);
    }
}
