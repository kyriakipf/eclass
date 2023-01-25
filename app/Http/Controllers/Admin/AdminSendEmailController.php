<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\customEmail;
use App\Mail\SendCustomMail;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminSendEmailController extends Controller
{
    public function index()
    {
        $emails = auth()->user()->messages()->paginate(5);

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
        $email = new Message([
            'from' => auth()->user()->email,
            'subject' => $request->emailSubject,
            'message' => $request->emailContent,
            'send_date' => Carbon::now()
        ]);
        $email->save();
        if ($request->userType == 'teacher') {
            $email->to = $request->teacherSelect;
            try
            {
                auth()->user()->messages()->attach($email->id);
                foreach ($request->teacherSelect as $teacher) {
                    Mail::to($teacher)->send(new SendCustomMail($request, null));

                    $user = User::query()->where('email', '=', $teacher)->first();
                    $user->messages()->attach($email->id);
                }
            }catch (\Exception $e)
            {
                $email->delete();
                return redirect()->back()->with('error','Υπήρξε πρόβλημα στην αποστολή του μηνύματος');
            }
        } elseif ($request->userType == 'student') {
            $email->to = $request->studentSelect;
            try
            {
                auth()->user()->messages()->attach($email->id);
                foreach ($request->studentSelect as $student) {
                    Mail::to($student)->send(new SendCustomMail($request, null));

                    $user = User::query()->where('email', '=', $student)->first();
                    $user->messages()->attach($email->id);
                }
            }catch (\Exception $e)
            {
                $email->delete();
                return redirect()->back()->with('error','Υπήρξε πρόβλημα στην αποστολή του μηνύματος');
            }

        } else {
            $email->to = $request->userSelect;
            try
            {
                auth()->user()->messages()->attach($email->id);
                foreach ($request->userSelect as $userEmail) {
                    Mail::to($userEmail)->send(new SendCustomMail($request, null));

                    $user = User::query()->where('email', '=', $userEmail)->first();
                    $user->messages()->attach($email->id);
                }
            }catch (\Exception $e)
            {
                $email->delete();
                return redirect()->back()->with('error','Υπήρξε πρόβλημα στην αποστολή του μηνύματος');
            }

        }
        $email->save();
        return redirect()->back()->with('success','Το μήνυμα στάλθηκε επιτυχώς');
    }

    public function show(Message $email)
    {
        return view('admin.showEmail', ['email' => $email]);
    }

    public function delete(Message $email)
    {
        auth()->user()->messages()->detach($email->id);

        return redirect()->route('admin.email')->with('success', 'Το μήνυμα διαγράφηκε');
    }

}

