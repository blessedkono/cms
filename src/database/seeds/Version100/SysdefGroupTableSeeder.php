<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Sysdef\Sysdef;

class SysdefGroupTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys("sysdef_groups");
        $this->delete('sysdef_groups');

        \DB::table('sysdef_groups')->insert(array (
            0 =>array (
                    'id' => 1,
                    'name' => 'Thresholds',
                    'description' => 'Threshold values',

                ),



        ));
        $this->enableForeignKeys("sysdef_groups");

    }
}