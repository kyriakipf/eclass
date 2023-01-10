<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteStudentCreated;
use App\Models\Domain;
use App\Models\InviteStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InviteStudentController extends Controller
{
    public function invite()
    {
        $domains = Domain::all();
        $students = InviteStudent::where('role_id', '=' , 3)->get();
        $registered = Student::all();
        return view('admin.invited.manageStudent', ['entities' => $students,'domains' => $domains , 'registered' => $registered]);
    }

    public function store(Request $request)
    {
        do {
            $token = Str::random();
        } //check if the token already exists and if it does, try again
        while (InviteStudent::where('token', $token)->first());
        //create a new invite record
        InviteStudent::create([
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'token' => $token,
            'am' => $request->am,
            'tmima' => auth()->user()->domain_id,
            'role_id' => 3
        ]);
        // redirect back where we came from
        return redirect()
            ->back()->with('success','Ο χρήστης προστέθηκε επιτυχώς.');
    }

    public function process(InviteStudent $student)
    {
        Mail::to($student->email)->send(new InviteStudentCreated($student));
        $student->update(['invited' => true]);
        // redirect back where we came from
        return redirect()
            ->back()->with('success','Η πρόσκληση στάλθηκε επιτυχώς.');
    }

    public function massProcess()
    {
        $students = InviteStudent::all()->where('invited', '=', false);
        foreach ($students as $student){
            Mail::to($student->email)->send(new InviteStudentCreated($student));
            $student->update(['invited' => true]);
        }
        // redirect back where we came from
        return redirect()->back()->with('success','Οι προσκλήσεις στάλθηκαν επιτυχώς.');
    }

    public function accept($token)
    {
        if (!$invite = InviteStudent::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        return view('auth.createPassword' , ['token' => $token] , ['invite' => $invite]);
    }

    public function update(Request $request ,InviteStudent $student){
        $student->update(['name' => $request->name , 'surname' => $request->surname , 'email' => $request->email, 'tmima' => auth()->user()->domain_id, 'am' => $request->am]);

//        return redirect()->back();
        return redirect()->route('student.invite')->with('success','Τα στοιχεία του χρήστη ενημερώθηκαν επιτυχώς.');
    }

    public function show(InviteStudent $student){
        $domains = Domain::all();

        return view('admin.invited.editStudent' , ['domains' => $domains , 'student' => $student]);
    }

    public function delete(InviteStudent $student){
        $student->delete();
        return redirect()->back()->with('success','Ο χρήστης διαγράφηκε επιτυχώς.');

    }
}
