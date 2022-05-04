<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();
        DB::table('teachers')->insert(array(
            array('id'=> 1,'user_id' => 2,  'phone' => '6979924250', 'eidikotita' => 'Pliroforiki', 'idiotita' => 'Epikouros', 'office_address' => 'Ipsilantou 12')
        ));
    }
}
