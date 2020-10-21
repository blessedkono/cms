<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class UnitsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('units');
        $this->delete('units');
//
//        \DB::table('units')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'name' => 'External Unit',
//                'unit_group_id' => '1',
//                'isactive' => 1,
//                'created_at' => '2019-01-27 08:27:49',
//                'updated_at' => NULL,
//                'deleted_at' => NULL,
//            ),
//
//        ));

        $this->enableForeignKeys('units');
    }
}
