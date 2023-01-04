<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        DB::table('students')->insert(array(
            array('id'=> 1,'user_id' => 3,
                'am' => 'e16115',
                'phone' => '6978825240',
                'address' => 'Aristeidou 21',
                'member_since'=> Carbon::create('2016', '10', '01'),
                )
        ));
    }
}
