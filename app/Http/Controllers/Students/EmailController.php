<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Mail\customEmail;
use App\Models\Message;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Message::all();

        $mail = new Collection();

        foreach ($emails as $email)
        {
            if (Str::contains($email->to, auth()->user()->email))
            {
                $mail->push($email);
            }
        }
        return view('student.viewEmails', ['emails' => $mail]);
    }

    public function create()
    {
        $teachers = Teacher::query()->whereRelation('user', 'domain_id', '=',  auth()->user()->domain_id)->get();

        return view('student.sendEmail', ['teachers' => $teachers]);
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
        return redirect()->route('student.email');
    }


    public function show(Message $email)
    {
        return view('student.showEmail', ['email' => $email]);
    }

    public function delete(Message $email)
    {
        $email->delete();
        return redirect()->route('student.email');
    }
}
