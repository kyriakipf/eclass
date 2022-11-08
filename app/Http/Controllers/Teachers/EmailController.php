<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Mail\customEmail;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Message::query()->where('from', '=', auth()->user()->email)->get();
        return view('teacher.viewEmails', ['emails' => $emails]);
    }

    public function create()
    {
        $students = Student::all();
//        TODO: MAKE GET RELATED STUDENTS METHOD
//        $students = Teacher::getRelatedStudents();
        return view('teacher.sendEmail', ['students' => $students]);
    }

    public function process(Request $request)
    {
        $email = new Message([
            'from' => auth()->user()->email,
            'subject' => $request->emailSubject,
            'message' => $request->emailContent,
            'send_date' => Carbon::now()
        ]);
        $email->save();

        $email->to = $request->userSelect;
        foreach ($request->userSelect as $user) {
            Mail::to($user)->send(new customEmail($request));
        }

        $email->save();
        return redirect()->route('teacher.email');
    }


    public function show(Message $email)
    {
        return view('teacher.showEmail', ['email' => $email]);
    }

    public function delete(Message $email)
    {
        $email->delete();
        return redirect()->route('teacher.email');
    }

}
