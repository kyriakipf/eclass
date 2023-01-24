<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(Student $student, Subject $subject)
    {
        $subjects = $student->subject()->whereRelation('teacher','teacher_id','=', auth()->user()->teacher->id)->paginate(10);
        return view('teacher.student.showStudent', ['student' => $student, 'subjects' => $subjects, 'subject' => $subject]);
    }
}
