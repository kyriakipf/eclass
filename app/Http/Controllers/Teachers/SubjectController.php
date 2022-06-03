<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        return view('teacher.subjects.manageSubjects', ['subjects' => $subjects]);
    }

    public function create()
    {

        $teachers = User::getRelatedTeachers();
        return view('teacher.subjects.createSubject' ,['teachers' => $teachers]);
    }
}
