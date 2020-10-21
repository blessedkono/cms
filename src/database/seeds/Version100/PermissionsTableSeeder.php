<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PermissionsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("permissions");
        $this->delete('permissions');

        \DB::table('permissions')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'permission_group_id' => 1,
                    'name' => 'all_functions',
                    'display_name' => 'All Functions',
                    'description' => 'Administrative rights to access all functions',
                    'ischecker' => 0,
                    'isadmin' => 1
                ),

            1 =>
                array (
                    'id' => 2,
                    'permission_group_id' => 2,
                    'name' => 'manage_roles_permissions',
                    'display_name' => 'Manage Roles and Permissions',
                    'description' => 'Manage Roles and Permissions',
                    'ischecker' => 0,
                    'isadmin' => 1
                ),

            2 =>
                array (
                    'id' => 3,
                    'permission_group_id' => 2,
                    'name' => 'manage_users',
                    'display_name' => 'Manage Users',
                    'description' => 'Users management',
                    'ischecker' => 0,
                    'isadmin' => 1
                ),

            3 =>
                array (
                    'id' => 4,
                    'permission_group_id' => 2,
                    'name' => 'manage_system',
                    'display_name' => 'Manage System',
                    'description' => 'Manage System',
                    'ischecker' => 0,
                    'isadmin' => 1
                ),
            4 =>
                array (
                    'id' => 5,
                    'permission_group_id' => 2,
                    'name' => 'admin_menu',
                    'display_name' => 'Administrator Menu',
                    'description' => 'View administrator menu',
                    'ischecker' => 0,
                    'isadmin' => 1
                ),

            5 =>
                array (
                    'id' => 6,
                    'permission_group_id' => 2,
                    'name' => 'workflow_allocation',
                    'display_name' => 'Workflow Allocation',
                    'description' => 'Workflow allocation and reallocation to staff',
                    'ischecker' => 0,
                    'isadmin' => 1
                ),

        ));
        $this->enableForeignKeys("permissions");

    }
}
