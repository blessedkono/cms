<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

/**
 * Class AccessTableSeeder.
 */
class Version100TableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();


        $this->call(RolesTableSeeder::class);
        $this->call(PermissionGroupTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(CodesTableSeeder::class);
        $this->call(CodeValuesTableSeeder::class);
        $this->call(DocumentGroupsTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(UnitGroupsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(WfGroupCategoriesTableSeeder::class);
        $this->call(WfModuleGroupsTableSeeder::class);
        $this->call(WfModulesTableSeeder::class);
        $this->call(WfDefinitionsTableSeeder::class);
        $this->call(SysdefGroupTableSeeder::class);
        $this->call(SysdefsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(ReportGroupTableSeeder::class);
        $this->call(ReportTypesTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(ReportGroupReportTableSeeder::class);

        DB::commit();

    }
}
