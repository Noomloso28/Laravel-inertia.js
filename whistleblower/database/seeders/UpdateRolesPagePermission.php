<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Permissions\Permission as PermissionName;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRolesPagePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => PermissionName::CAN_VIEW_ROLES]);
        Permission::create(['name' => PermissionName::CAN_CREATE_ROLES]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_ROLES]);
        Permission::create(['name' => PermissionName::CAN_DELETE_ROLES]);

        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo([
            PermissionName::CAN_VIEW_ROLES,
            PermissionName::CAN_CREATE_ROLES,
            PermissionName::CAN_UPDATE_ROLES,
            PermissionName::CAN_DELETE_ROLES
        ]);
    }
}
