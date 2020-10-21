<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class DocumentGroupsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys("document_groups");
        $this->delete('document_groups');

        \DB::table('document_groups')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Blog Documents',
                    'top_path' => '/storage/cms/blog',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Client Documents',
                    'top_path' => '/storage/cms/blog',
                ),


        ));
        $this->enableForeignKeys("document_groups");


        /*Make directory for top path for each doc group*/
        (new \App\Repositories\System\DocumentGroupRepository())->makeDirectoryTopPath();

    }
}
