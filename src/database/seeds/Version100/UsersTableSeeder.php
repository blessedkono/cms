<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys("users");
//        $this->delete('users');
//        \DB::table('users')->where('id', 1)->delete();
//        $userRepo = new \App\Repositories\Access\UserRepository();
//        $user = $userRepo->query()->updateOrCreate([
//            //'id' => '1',
//            'email' => 'admin@tbs-oas.go.tz',
//            'password' => bcrypt('TBSOASadmin'),
//            'confirmed' => '1',
//        ]);
//        $this->enableForeignKeys("users");
//
//        $this->disableForeignKeys('staffs');
//        $staff = new \App\Repositories\Staff\StaffRepository();
//        $staff->query()->updateOrCreate([
//            'user_id' => $user->id,
//            'staff_identity' => 'Tbs-001',
//            'firstname' => 'Admin',
//            'lastname' => 'TBS',
//            'email' => 'admin@tbs-oas.go.tz',
//            'created_by' => '0',
//            'designation_id' => 6,
//            'unit_id' => 2,
//            'port_id' => 1,
//        ]);
//        $this->enableForeignKeys("staffs");
//
//        $this->disableForeignKeys('role_user');
//        \DB::table('role_user')->where('user_id', $user->id)->delete();
//
//
//        \DB::table('role_user')->insert(array (
//            0 =>
//                array(
//                    'id'      => '1',
//                    'user_id' => $user->id,
//                    'role_id' => '1'
//                )
//        ));
        $this->enableForeignKeys("role_user");

    }
}

