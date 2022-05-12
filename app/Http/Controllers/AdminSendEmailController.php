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
    public function index()
    {
        $teachers = User::getRelatedTeachers();
        $students = User::getRelatedStudents();
        return view('admin.sendEmail', ['teachers' => $teachers, 'students' => $students]);
    }

    public function process(Request $request)
    {
//        dd($request);
        if ($request->userType == 'teacher') {

            foreach ($request->teacherSelect as $teacher) {
                Mail::to($teacher)->send(new customEmail($request));
            }
        } elseif ($request->userType == 'student') {
            foreach ($request->studentSelect as $student) {
                Mail::to($student)->send(new customEmail($request));
            }
        } else {
            foreach ($request->userSelect as $user) {
                Mail::to($user)->send(new customEmail($request));
            }
        }

        return redirect()->back();
    }

}

