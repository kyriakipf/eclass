<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            array('id'=> 1,  'email' => 'admin@email.com', 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'name' => 'Name1', 'surname' => 'Surname1', 'role_id' => 1 , 'tmima' => 2),
            array('id'=> 2,  'email' => 'teacher@email.com', 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'name' => 'Name2', 'surname' => 'Surname2', 'role_id' => 2, 'tmima' => 2),
            array('id'=> 3,  'email' => 'student@email.com', 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'name' => 'Name3', 'surname' => 'Surname3', 'role_id' => 3, 'tmima' => 2),
        ));
    }
}
