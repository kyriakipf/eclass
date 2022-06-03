<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\customEmail;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminSendEmailController extends Controller
{
    public function index()
    {
        $emails = Message::all();
        return view('admin.viewEmails' , ['emails' => $emails]);
    }

    public function create()
    {
        $teachers = User::getRelatedTeachers();
        $students = User::getRelatedStudents();
        return view('admin.sendEmail', ['teachers' => $teachers, 'students' => $students]);
    }

    public function process(Request $request)
    {
//        dd($request);
        $email = new Message([
            'from' => auth()->user()->email,
            'subject' => $request->emailSubject,
            'message' => $request->emailContent,
            'send_date' => Carbon::now()
        ]);
        $email->save();
        if ($request->userType == 'teacher') {
            $email->to = $request->teacherSelect;

            foreach ($request->teacherSelect as $teacher) {
                Mail::to($teacher)->send(new customEmail($request));
            }
        } elseif ($request->userType == 'student') {
            $email->to = $request->studentSelect;
            foreach ($request->studentSelect as $student) {
                Mail::to($student)->send(new customEmail($request));
            }
        } else {
            $email->to = $request->userSelect;
            foreach ($request->userSelect as $user) {
                Mail::to($user)->send(new customEmail($request));
            }
        }
        $email->save();
        return redirect()->back();
    }

}

