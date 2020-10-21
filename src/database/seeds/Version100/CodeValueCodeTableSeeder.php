<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class CodeValueCodeTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys("code_value_code");
        $this->delete('code_value_code');

        \DB::table('code_value_code')->insert(array (
//            0 => array (
//                'id' => 27,
//                'code_value_id' => 114,
//                'code_id' => 34,
//                'iscategory' => 0,
//            ),

        ));
        $this->enableForeignKeys("code_value_code");

    }
}
