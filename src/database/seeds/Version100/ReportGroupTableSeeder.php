<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class ReportGroupTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->disableForeignKeys('report_groups');
        $this->delete('report_groups');

        \DB::table('report_groups')->insert(array (
//            0 =>
//                array (
//                    'id' => 1,
//                    'name' => 'Stakeholder',
//                    'created_at' => '2019-06-01 17:46:12',
//                    'updated_at' => NULL,
//                ),




        ));

        $this->enableForeignKeys('report_groups');
    }

}
