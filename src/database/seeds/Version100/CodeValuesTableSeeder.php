<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\System\CodeValue;

class CodeValuesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys("code_values");

//        CodeValue::query()->delete();
        $cv = CodeValue::updateOrCreate(
            ['reference' => 'ULLGI'],
            [
//                'id' => 1,
                'code_id' => 1,
                'name' => 'Log In',
                'lang' => NULL,
                'description' => '',
                'reference' => 'ULLGI',
                'sort' => 1,
                'isactive' => 1,
                'is_system_defined' => 1,
            ]
        );

        $cv = CodeValue::updateOrCreate(
            ['reference' => 'ULLGO'],
            [
//                'id' => 2,
                'code_id' => 1,
                'name' => 'Log Out',
                'lang' => NULL,
                'description' => '',
                'reference' => 'ULLGO',
                'sort' => 2,
                'isactive' => 1,
                'is_system_defined' => 1,
            ]
        );

        $cv = CodeValue::updateOrCreate(
            ['reference' => 'ULFLI'],
            [
//                'id' => 3,
                'code_id' => 1,
                'name' => 'Failed Log In',
                'lang' => NULL,
                'description' => '',
                'reference' => 'ULFLI',
                'sort' => 3,
                'isactive' => 1,
                'is_system_defined' => 1,
            ]
        );

        $cv = CodeValue::updateOrCreate(
            ['reference' => 'ULPSR'],
            [
//                'id' => 4,
                'code_id' => 1,
                'name' => 'Password Reset',
                'lang' => NULL,
                'description' => '',
                'reference' => 'ULPSR',
                'sort' => 4,
                'isactive' => 1,
                'is_system_defined' => 1,
            ]
        );

        $cv = CodeValue::updateOrCreate(
            ['reference' => 'ULULC'],
            [
//                'id' => 5,
                'code_id' => 1,
                'name' => 'User Lockout',
                'lang' => NULL,
                'description' => '',
                'reference' => 'ULULC',
                'sort' => 5,
                'isactive' => 1,
                'is_system_defined' => 1,
            ]
        );

        $this->enableForeignKeys("code_values");


    }
}
