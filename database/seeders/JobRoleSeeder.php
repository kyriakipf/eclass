<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_roles')->delete();
        DB::table('job_roles')->insert(array(
            array('id'=> 1,  'name'=>'Καθηγητής'),
            array('id'=> 2,  'name'=>'Αναπληρωτής Καθηγητής'),
            array('id'=> 3,  'name'=>'Επίκουρος Καθηγητής'),
            array('id'=> 4,  'name'=>'Ομότιμος Καθηγητής'),
            array('id'=> 5,  'name'=>'Τεχνικό Προσωπικό'),
        ));
    }
}
