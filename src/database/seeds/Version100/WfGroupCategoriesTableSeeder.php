<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Workflow\WfModuleGroup;
use \App\Models\Workflow\WfGroupCategory;

class WfGroupCategoriesTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('wf_group_categories');

//        $wf_category = WfGroupCategory::updateOrCreate(
//            array ( 'id' => 1),
//            array (
//                'id' => 1,
//                'name' => 'Stakeholders',
//                 'created_at' => '2019-01-27 08:27:49',
//                'updated_at' => NULL,
//                'deleted_at' => NULL,
//            )
//                );


        $this->enableForeignKeys('wf_group_categories');
    }
}
