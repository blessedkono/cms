<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PermissionGroupTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('permission_groups');
        $this->delete('permission_groups');

        \DB::table('permission_groups')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Special',
                    'created_at' => '2018-10-28 14:54:12',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Admin',
                    'created_at' => '2019-10-28 14:54:12',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 3,
                    'name' => 'Report',
                    'created_at' => '2019-10-28 14:54:12',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),

        ));

        $this->enableForeignKeys('permission_groups');
    }
}