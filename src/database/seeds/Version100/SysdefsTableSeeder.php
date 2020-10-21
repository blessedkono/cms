<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\System\Sysdef;

class SysdefsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'THMJCA'],
            [
                'name' => 'max_job_count_for_alert',
                'display_name' => 'Max jobs count for alerting admin',
                'value' => '20',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'THMJCA',
                'sysdef_group_id' => 1,
            ]
        );




    }
}
