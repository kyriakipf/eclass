<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->delete();
        DB::table('semesters')->insert(array(
            array(
                'id'=> 1,
                'number' => '1',
                'type'=> 'Χειμερινό',
                'starts_at'=>'Οκτώβριος',
                'ends_at'=>'Φεβρουάριος',
            ),
            array(
                'id'=> 2,
                'number' => '2',
                'type'=>'Εαρινό',
                'starts_at'=>'Μάρτιος',
                'ends_at'=>'Ιούλιος',
            ),
            array(
                'id'=> 3,
                'number' => '3',
                'type'=> 'Χειμερινό',
                'starts_at'=>'Οκτώβριος',
                'ends_at'=>'Φεβρουάριος',
            ),
            array(
                'id'=> 4,
                'number' => '4',
                'type'=>'Εαρινό',
                'starts_at'=>'Μάρτιος',
                'ends_at'=>'Ιούλιος',
            ),
            array(
                'id'=> 5,
                'number' => '5',
                'type'=> 'Χειμερινό',
                'starts_at'=>'Οκτώβριος',
                'ends_at'=>'Φεβρουάριος',
            ),
            array(
                'id'=> 6,
                'number' => '6',
                'type'=>'Εαρινό',
                'starts_at'=>'Μάρτιος',
                'ends_at'=>'Ιούλιος',
            ),
            array(
                'id'=> 7,
                'number' => '7',
                'type'=> 'Χειμερινό',
                'starts_at'=>'Οκτώβριος',
                'ends_at'=>'Φεβρουάριος',
            ),
            array(
                'id'=> 8,
                'number' => '8',
                'type'=>'Εαρινό',
                'starts_at'=>'Μάρτιος',
                'ends_at'=>'Ιούλιος',
            ),
        ));
    }
}
