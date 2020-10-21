<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class ReportGroupReportTableSeeder extends Seeder
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
        $this->disableForeignKeys('report_group_report');
        $this->delete('report_group_report');

        \DB::table('report_group_report')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'report_id' => 1,
                    'report_group_id' => 1,
                    'updated_at' => NULL,
                ),


        ));

        $this->enableForeignKeys('report_groups');
    }

}
