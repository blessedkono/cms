<?php


use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class ReportsTableSeeder extends Seeder
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
        $this->disableForeignKeys('reports');
        $this->delete('reports');

//        \DB::table('reports')->insert(array (
//            0 => array (
//                'id' => 1,
//                'name' => 'Company registrations',
//                'url_name' => 'company_registrations',
//                'report_type_id' => 1,
//                'report_category_id' => 1,
//                'description' => 'Report based on company registrations',
//                'isactive' => 1,
//                'created_at' => '2019-06-24 6:12',
//                'updated_at' => NULL,
//            ),
//
//
//        ));

        $this->enableForeignKeys('reports');
    }
}
