<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert(array(
            array('id'=> 1,  'role_name' => 'Administrator'),
            array('id'=> 2, 'role_name' => 'Teacher'),
            array('id'=> 3, 'role_name' => 'Student'),
        ));
    }
}
