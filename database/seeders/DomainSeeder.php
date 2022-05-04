<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->delete();
        DB::table('domains')->insert(array(
            array('id'=> 1,  'name'=>'Ψηφιακά Συστήματα'),
            array('id'=> 2,  'name'=>'Πληροφορική'),
            array('id'=> 3,  'name'=>'Τουριστικών Σπουδών'),
        ));
    }
}
