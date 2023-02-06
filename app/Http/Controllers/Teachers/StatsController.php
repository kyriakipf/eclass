<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {

        //Data for allSubjects pie chart

        $allSubjects = auth()->user()->teacher->subject;
        $allStudents = [];

        foreach ($allSubjects as $subject) {
            $allStudents[] = count($subject->student);
        }


        //Data for students per semester bar chart

        $semesters = Semester::all();
        $semesterStudents = [];
        $allSemesters = [];

        foreach ($semesters as $semester)
        {
            $subjects = $semester->subject;
            $students = 0;

            $allSemesters[] = $semester->number . 'ο Εξάμηνο';

            foreach ($subjects as $subject)
            {
                $students += count($subject->student);
            }

            $semesterStudents[] = $students;
        }

        //Data for homework per semester

        $hwData = [];
        foreach ($semesters as $semester)
        {
            $numHw = 0;
            $subjects = $semester->subject;
            foreach ($subjects as $subject)
            {
                $numHw += count($subject->homework);
            }

            $hwData []= $numHw;
        }

        $allSubjects = $allSubjects->pluck('title');

        return view('teacher.stats.index', ['allSubjects' => json_encode($allSubjects), 'allStudents' => json_encode($allStudents),
            'allSemesters' => json_encode($allSemesters), 'semesterStudents' => json_encode($semesterStudents), 'hwData' => json_encode($hwData)]);
    }


}
