<?php

namespace Database\Seeders;

use App\Permissions\Permission as PermissionName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class addEmailPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => PermissionName::CAN_VIEW_EMAIL]);
        Permission::create(['name' => PermissionName::CAN_CREATE_EMAIL]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_EMAIL]);
        Permission::create(['name' => PermissionName::CAN_DELETE_EMAIL]);

        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo([
            PermissionName::CAN_VIEW_EMAIL,
            PermissionName::CAN_CREATE_EMAIL,
            PermissionName::CAN_UPDATE_EMAIL,
            PermissionName::CAN_DELETE_EMAIL
        ]);

    }
}
