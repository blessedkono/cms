<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Workflow\WfModule;

class WfModulesTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('wf_modules');

//        $wf_module = WfModule::updateOrCreate(
//            array ( 'id' => 1),
//            array (
//                'id' => 1,
//                'name' => 'User registrations',
//                'wf_module_group_id' => '1',
//                'created_at' => '2019-01-27 08:27:49',
//                'updated_at' => NULL,
//                'deleted_at' => NULL,
//                'isactive' => '1',
//                'type' => '1',
//                'description' => '',
//                'allow_repeat' => 0,
//            )
//        );


        $this->enableForeignKeys('wf_modules');
    }
}
