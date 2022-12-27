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
                'starts_at'=>Carbon::create(null , '10', '01'),
                'ends_at'=>Carbon::create(null, '03', '01'),
            ),
            array(
                'id'=> 2,
                'number' => '2',
                'starts_at'=>Carbon::create(null, '03', '01'),
                'ends_at'=>Carbon::create(null, '08', '01'),
            ),
            array(
                'id'=> 3,
                'number' => '3',
                'starts_at'=>Carbon::create(null , '10', '01'),
                'ends_at'=>Carbon::create(null, '03', '01'),
            ),
            array(
                'id'=> 4,
                'number' => '4',
                'starts_at'=>Carbon::create(null, '03', '01'),
                'ends_at'=>Carbon::create(null, '08', '01'),
            ),
            array(
                'id'=> 5,
                'number' => '5',
                'starts_at'=>Carbon::create(null , '10', '01'),
                'ends_at'=>Carbon::create(null, '03', '01'),
            ),
            array(
                'id'=> 6,
                'number' => '6',
                'starts_at'=>Carbon::create(null, '03', '01'),
                'ends_at'=>Carbon::create(null, '08', '01'),
            ),
            array(
                'id'=> 7,
                'number' => '7',
                'starts_at'=>Carbon::create(null , '10', '01'),
                'ends_at'=>Carbon::create(null, '03', '01'),
            ),
            array(
                'id'=> 8,
                'number' => '8',
                'starts_at'=>Carbon::create(null, '03', '01'),
                'ends_at'=>Carbon::create(null, '08', '01'),
            ),
        ));
    }
}
