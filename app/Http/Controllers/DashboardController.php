<?php

namespace App\Http\Controllers;

use App\Models\InviteStudent;
use App\Models\InviteTeacher;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $teachers = Teacher::all();
        $students = Student::all();
        $invitedTeachers = InviteTeacher::all();
        $invitedStudents = InviteStudent::all();
        $user = auth()->user();
        if ($user->role_id == 1){
            return view('admin.index', ['teachers' => $teachers , 'students' => $students , 'invitedTeachers' => $invitedTeachers , 'invitedStudents' => $invitedStudents]);
        }elseif ($user->role_id == 2){
            return view('teacher.index');
        }elseif($user->role_id == 3){
            $student = Student::query()->where('user_id', '=' , auth()->user()->id)->first();
            return view('student.index', ['student' => $student]);
        }else{
            return view('login');
        }

    }
}
