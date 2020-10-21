<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use \App\Models\Workflow\WfDefinition;

class WfDefinitionsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('wf_definitions');

//        $wf_definition = WfDefinition::updateOrCreate(
//            array ( 'id' => 1),
//            array (
//                'id' => 1,
//                'level' => '1',
//                'unit_id' => '1',
//                'designation_id' => '1',
//                'description' => 'User register receive',
//                'msg_next' => 'Receive registration and forward to senior.',
//                'wf_module_id' => '1',
//                'active' => '1',
//                'allow_rejection' => 1,
//                'allow_repeat_participate' => 0,
//                'created_at' => '2019-11-20 12:33:26',
//                'updated_at' => NULL,
//                'deleted_at' => NULL,
//                'is_approval' => 0,
//                'has_next_start_optional' => 0,
//                'action_description' => 'Approval',
//                'is_optional' => 0,
//                'has_note' => 0,
//                'isselective' => 0,
//                'selective' => 0,
//
//            )
//
//        );



        $this->enableForeignKeys('wf_definitions');

    }
}
