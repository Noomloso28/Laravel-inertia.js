<?php

namespace Database\Seeders;

use App\Permissions\Permission as PermissionName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRolePagePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managerRole = Role::findByName('admin');
        $managerRole->givePermissionTo([
            PermissionName::CAN_VIEW_ROLES,
            PermissionName::CAN_CREATE_ROLES,
            PermissionName::CAN_UPDATE_ROLES,
            PermissionName::CAN_DELETE_ROLES,
        ]);
    }
}
