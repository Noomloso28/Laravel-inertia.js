<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MigrationImportData extends Seeder
{
    public function run()
    {
        /** create default data */
//        $this->call(CagegoriesDefault::class); add ready
//        $this->call(departmentsDefault::class); add ready


        /** add seed data after setup system has done */
        $this->call(RoleSeeder::class);
        $this->call([RoleAndPermissionSeeder::class]);
        $this->call(UpdatePermissions::class);
        $this->call(UpdateRolesPagePermission::class);
        $this->call([ManagerPermissionsSeeder::class]);
        $this->call(AdminRolePagePermission::class);
        $this->call(AddAdminAccount::class);
        $this->call(UpdateUsersInCompanyPermission::class);
        $this->call(addEmailPermissions::class);
        /** end this line */


    }
}
