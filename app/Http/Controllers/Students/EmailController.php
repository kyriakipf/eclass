<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Mail\customEmail;
use App\Mail\SendCustomMail;
use App\Models\Message;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    public function index()
    {
        $emails = auth()->user()->messages()->paginate(5);

        return view('student.viewEmails', ['emails' => $emails]);
    }

    public function create()
    {
        $subjects = auth()->user()->student->subject;
        $teachers = Teacher::query()->whereRelation('user', 'domain_id', '=', auth()->user()->domain_id)->get();

        return view('student.sendEmail', ['teachers' => $teachers, 'subjects' => $subjects]);
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
        $teacher = $sub->teacher;
        foreach ($teacher as $t)
        {
            $to = $t->user->email;
        }

        try
        {
            auth()->user()->messages()->attach($email->id);

            Mail::to($to)->send(new SendCustomMail($request, $sub->title));

            $user = User::query()->where('email', '=', $to)->first();
            $user->messages()->attach($email->id);

            $email->save();
        } catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'Υπήρξε πρόβλημα με την αποστολή του μηνύματος');
        }

        return redirect()->route('student.email')->with('success', 'Το μήνυμα στάλθηκε επιτυχώς');
    }


    public function show(Message $email)
    {
        return view('student.showEmail', ['email' => $email]);
    }

    public function delete(Message $email)
    {
        auth()->user()->messages()->detach($email->id);
        return redirect()->route('student.email')->with('success', 'Το μήνυμα διαγράφηκε επιτυχώς');
    }
}
