<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class ReportTypesTableSeeder extends Seeder
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
        //
        $this->disableForeignKeys('report_types');
        $this->delete('report_types');

        \DB::table('report_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Table',
                    'created_at' => '2017-06-01 6:12',
                    'updated_at' => NULL,
                ),

        ));

        $this->enableForeignKeys('report_types');
    }
}
