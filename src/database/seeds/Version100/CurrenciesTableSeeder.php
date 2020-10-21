<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class CurrenciesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("currencies");
        $this->delete('currencies');
        \DB::table('currencies')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Tanzania Shillings',
                    'code' => 'TZS',
                    'exch_rate' => '1.00',
                    'isactive' => 1,
                    'created_at' => '2019-10-28 08:07:49',
                    'updated_at' => NULL,

                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'US Dollar',
                    'code' => 'USD',
                    'exch_rate' => '2230',
                    'isactive' => 1,
                    'created_at' => '2019-10-28 08:07:49',
                    'updated_at' => NULL,

                ),
        ));


        $this->enableForeignKeys("currencies");
        
    }
}