<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Mail\customEmail;
use App\Mail\SendCustomMail;
use App\Models\Message;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;

class EmailController extends Controller
{
    public function index()
    {
        $emails = auth()->user()->messages()->paginate(5);
        return view('teacher.viewEmails', ['emails' => $emails]);
    }

    public function create()
    {
        $subjects = auth()->user()->teacher->subject;
        $students = Student::query()->whereRelation('user','domain_id','=', auth()->user()->domain_id)->get();
        return view('teacher.sendEmail', ['students' => $students, 'subjects' => $subjects]);
    }

    public function createForSubject(Subject $subject)
    {
        $students = $subject->student;
        return view('teacher.sendEmail', ['students' => $students]);
    }

    public function process(Request $request)
    {
        $email = new Message([
            'from' => auth()->user()->email,
            'subject' => $request->emailSubject,
            'message' => $request->emailContent,
            'subject_id' => $request->subjectSelect,
            'send_date' => Carbon::now()
        ]);
        $email->save();
        $sub = Subject::find($request->subjectSelect);

        $students = $sub->student;
        if(count($students) == 0)
        {
            $email->delete();
            return redirect()->back()->with('error', 'Δεν υπάρχουν εγγεγραμένοι μαθητές στο μάθημα');
        }
        try
        {
            $email->to = $request->userSelect;
            $email->save();
            auth()->user()->messages()->attach($email->id);
            foreach ($students as $student) {
                Mail::to($student->user->email)->send(new SendCustomMail($request,$sub->title));

                $user = User::query()->where('email', '=', $student->user->email)->first();
                $user->messages()->attach($email->id);
            }
        }catch (\Exception $e)
        {
            $email->delete();
            return redirect()->back()->with('error', 'Υπήρξε πρόβλημα στην αποστολή του μηνύματος');
        }

        return redirect()->route('teacher.email')->with('success', 'Το μήνυμα στάλθηκε επιτυχώς');
    }


    public function show(Message $email)
    {
        return view('teacher.showEmail', ['email' => $email]);
    }

    public function delete(Message $email)
    {
        auth()->user()->messages()->detach($email->id);

        return redirect()->route('teacher.email')->with('success', 'Το μήνυμα διαγράφηκε επιτυχώς');
    }

}
