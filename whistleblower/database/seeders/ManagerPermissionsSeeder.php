<?php

namespace Database\Seeders;

use App\Permissions\Permission as PermissionName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class ManagerPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managerRole = Role::findByName('manager');
        $managerRole->givePermissionTo([
            PermissionName::CAN_VIEW_USERS,
            PermissionName::CAN_CREATE_USERS,
            PermissionName::CAN_UPDATE_USERS,
            PermissionName::CAN_DELETE_USERS,
        ]);
    }
}
