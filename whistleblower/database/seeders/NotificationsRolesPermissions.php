<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Permissions\Permission as PermissionName;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NotificationsRolesPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => PermissionName::CAN_VIEW_NOTIFICATIONS]);
        Permission::create(['name' => PermissionName::CAN_CREATE_NOTIFICATIONS]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_NOTIFICATIONS]);
        Permission::create(['name' => PermissionName::CAN_DELETE_NOTIFICATIONS]);

        $adminRole = Role::findByName('admin');

        $adminRole->givePermissionTo([
            PermissionName::CAN_VIEW_NOTIFICATIONS,
            PermissionName::CAN_CREATE_NOTIFICATIONS,
            PermissionName::CAN_UPDATE_NOTIFICATIONS,
            PermissionName::CAN_DELETE_NOTIFICATIONS,
        ]);
    }
}
