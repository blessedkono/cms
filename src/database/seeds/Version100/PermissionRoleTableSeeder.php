<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("permission_role");
//        $this->delete('permission_role');
        $count = DB::table('permission_role')->count();
        if ($count == 0){
            \DB::table('permission_role')->insert(array(
//            0 =>
//            array (
//                'permission_id' => 1,
//                'role_id' => 1,
//            ),
//
            ));
    }

        $this->enableForeignKeys("permission_role");

    }
}
