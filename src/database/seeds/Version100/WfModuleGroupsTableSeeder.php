<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Workflow\WfModuleGroup;

class WfModuleGroupsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('wf_module_groups');

//        $wf_group = WfModuleGroup::updateOrCreate(
//            array ( 'id' => 1),
//            array (
//                'id' => 1,
//                'name' => 'User Registrations',
//                'table_name' => 'users',
//                'created_at' => '2019-01-27 08:27:49',
//                'updated_at' => NULL,
//                'deleted_at' => NULL,
//            )
//                );


        $this->enableForeignKeys('wf_module_groups');
    }
}
