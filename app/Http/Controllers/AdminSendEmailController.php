<?php

namespace App\Http\Controllers;

use App\Mail\customEmail;
use App\Mail\InviteStudentCreated;
use App\Models\InviteStudent;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminSendEmailController extends Controller
{
    public function index(){
        $teachers = User::getRelatedTeachers();
        $students = User::getRelatedStudents();
        return view('admin.sendEmail', ['teachers' => $teachers , 'students' => $students]);
    }

    public function process(Request $request)
    {
        if($request->userType == 'teacher'){
            foreach ($request->teacherSelect as $teacher){
                dd($teacher['email']);
                Mail::to($teacher->email)->send(new customEmail($request));
            }
        }elseif ($request->userType == 'student'){

        }else{

        }
        dd($request);
    }

}
