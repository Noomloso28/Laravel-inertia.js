<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Permissions\Permission as PermissionName;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** delete old */
//        $permissions = Role::findByName('admin user writer');
//        $permissions->delete();

        Permission::create(['name' => PermissionName::CAN_VIEW_USERS]);
        Permission::create(['name' => PermissionName::CAN_CREATE_USERS]);
        Permission::create(['name' => PermissionName::CAN_UPDATE_USERS]);
        Permission::create(['name' => PermissionName::CAN_DELETE_USERS]);

//        Permission::create(['name' => PermissionName::CAN_CREATE_BLOG_POSTS]);
//        Permission::create(['name' => PermissionName::CAN_VIEW_BLOG_POSTS]);
//        Permission::create(['name' => PermissionName::CAN_UPDATE_BLOG_POSTS]);
//        Permission::create(['name' => PermissionName::CAN_DELETE_BLOG_POSTS]);

        $adminRole = Role::findByName('admin');
        $userRole = Role::findByName('user');

        $adminRole->givePermissionTo([
            PermissionName::CAN_VIEW_USERS,
            PermissionName::CAN_CREATE_USERS,
            PermissionName::CAN_UPDATE_USERS,
            PermissionName::CAN_DELETE_USERS,
//            PermissionName::CAN_VIEW_BLOG_POSTS,
//            PermissionName::CAN_CREATE_BLOG_POSTS,
//            PermissionName::CAN_UPDATE_BLOG_POSTS,
//            PermissionName::CAN_DELETE_BLOG_POSTS,
        ]);

//        $userRole->givePermissionTo([
//            PermissionName::CAN_VIEW_BLOG_POSTS,
//            PermissionName::CAN_CREATE_BLOG_POSTS,
//            PermissionName::CAN_UPDATE_BLOG_POSTS,
//            PermissionName::CAN_DELETE_BLOG_POSTS,
//        ]);

    }
}
