<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class UnitGroupsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('unit_groups');
        $this->delete('unit_groups');

//        \DB::table('unit_groups')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'name' => 'External Unit',
//                'created_at' => '2019-01-27 08:27:49',
//                'updated_at' => NULL,
//                'deleted_at' => NULL,
//            ),
//
//        ));

        $this->enableForeignKeys('unit_groups');
    }
}
