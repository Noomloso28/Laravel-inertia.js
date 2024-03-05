<?php

namespace Database\Seeders;

use App\Permissions\Permission as PermissionName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateUsersInCompanyPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => PermissionName::CAN_VIEW_USERS_IN_COMPANY]);
        Permission::create(['name' => PermissionName::CAN_CREATE_USERS_IN_COMPANY]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_USERS_IN_COMPANY]);
        Permission::create(['name' => PermissionName::CAN_DELETE_USERS_IN_COMPANY]);
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo([
            PermissionName::CAN_VIEW_USERS_IN_COMPANY,
            PermissionName::CAN_CREATE_USERS_IN_COMPANY,
            PermissionName::CAN_UPDATE_USERS_IN_COMPANY,
            PermissionName::CAN_DELETE_USERS_IN_COMPANY
        ]);
    }
}
