<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Permissions\Permission as PermissionName;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdatePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => PermissionName::CAN_VIEW_USER_COMPANY]);
        Permission::create(['name' => PermissionName::CAN_CREATE_USER_COMPANY]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_USER_COMPANY]);
        Permission::create(['name' => PermissionName::CAN_DELETE_USER_COMPANY]);

        Permission::create(['name' => PermissionName::CAN_VIEW_COMPANIES ]);
        Permission::create(['name' => PermissionName::CAN_CREATE_COMPANIES]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_COMPANIES]);
        Permission::create(['name' => PermissionName::CAN_DELETE_COMPANIES]);

        Permission::create(['name' => PermissionName::CAN_VIEW_OCCURRENCES]);
        Permission::create(['name' => PermissionName::CAN_CREATE_OCCURRENCES]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_OCCURRENCES]);
        Permission::create(['name' => PermissionName::CAN_DELETE_OCCURRENCES]);

        Permission::create(['name' => PermissionName::CAN_VIEW_DEPARTMENTS]);
        Permission::create(['name' => PermissionName::CAN_CREATE_DEPARTMENTS]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_DEPARTMENTS]);
        Permission::create(['name' => PermissionName::CAN_DELETE_DEPARTMENTS]);

        Permission::create(['name' => PermissionName::CAN_VIEW_CATEGORIES]);
        Permission::create(['name' => PermissionName::CAN_CREATE_CATEGORIES]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_CATEGORIES]);
        Permission::create(['name' => PermissionName::CAN_DELETE_CATEGORIES]);

        Permission::create(['name' => PermissionName::CAN_VIEW_NOTES]);
        Permission::create(['name' => PermissionName::CAN_CREATE_NOTES]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_NOTES]);
        Permission::create(['name' => PermissionName::CAN_DELETE_NOTES]);

        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo([
            PermissionName::CAN_VIEW_USER_COMPANY,
            PermissionName::CAN_CREATE_USER_COMPANY,
            PermissionName::CAN_UPDATE_USER_COMPANY,
            PermissionName::CAN_DELETE_USER_COMPANY,
            PermissionName::CAN_VIEW_COMPANIES,
            PermissionName::CAN_CREATE_COMPANIES,
            PermissionName::CAN_UPDATE_COMPANIES,
            PermissionName::CAN_DELETE_COMPANIES
        ]);
    }
}
