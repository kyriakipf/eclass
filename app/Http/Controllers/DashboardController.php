<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();
        if ($user->role_id == 1){
            return view('admin.index');
        }elseif ($user->role_id == 2){
            $teacher = Teacher::query()->where('profile_id', '=' , auth()->user()->id)->first();
            return view('teacher.index', ['teacher' => $teacher]);
        }elseif($user->role_id == 3){
            $student = Student::query()->where('profile_id', '=' , auth()->user()->id)->first();
            return view('student.index', ['student' => $student]);
        }else{
            return view('login');
        }

    }
}
