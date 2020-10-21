<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class DocumentsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("documents");
        $this->delete('documents');

        \DB::table('documents')->insert(array (
            0 => array (
                    'id' => 1,
                    'name' => 'Blog photos',
                    'document_group_id' => 1,
                    'description' => 'This are blog pictures',
                    'isrecurring' => 1,
                    'ismandatory' => 1,
                    'isrenewable' => 1,
                    'isactive' => 1,
                ),
            1 => array (
                    'id' => 2,
                    'name' => 'Client logo',
                    'document_group_id' => 2,
                    'description' => 'This is client logo',
                    'isrecurring' => 1,
                    'ismandatory' => 1,
                    'isrenewable' => 1,
                    'isactive' => 1,
                ),



        ));

        $this->enableForeignKeys("documents");

    }
}
