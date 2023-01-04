<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteTeacherCreated;
use App\Models\Domain;
use App\Models\InviteTeacher;
use App\Models\JobRole;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InviteTeacherController extends Controller
{
    public function invite()
    {
        $domains = Domain::all();
        $teachers = InviteTeacher::where('role_id', '=' , 2)->get();
        $registeredTeachers = Teacher::all();
        $job_roles = JobRole::all();
        return view('admin.invited.manageTeacher', ['entities' => $teachers, 'registered' => $registeredTeachers,'domains' => $domains, 'job_roles' => $job_roles]);
    }

    public function store(Request $request)
    {
        do {
            //generate a random string using Laravel's str_random helper
            $token = Str::random();
        } //check if the token already exists and if it does, try again
        while (InviteTeacher::where('token', $token)->first());
        //create a new invite record
        InviteTeacher::create([
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'tmima' => $request->domain,
            'job_role_id' => $request->job_role,
            'role_id' => 2,
            'invited'=> false,
            'token' => $token
        ]);
        // redirect back where we came from
        return redirect()
            ->back()->with('success','Ο χρήστης προστέθηκε επιτυχώς.');
    }

    public function process(InviteTeacher $teacher)
    {
        Mail::to($teacher->email)->send(new InviteTeacherCreated($teacher));
        $teacher->update(['invited' => true]);
        // redirect back where we came from
        return redirect()
            ->back()->with('success','Η πρόσκληση στάλθηκε επιτυχώς.');
    }

    public function massProcess()
    {
        $teachers = InviteTeacher::all()->where('invited', '=', false);
        foreach ($teachers as $teacher){
        Mail::to($teacher->email)->send(new InviteTeacherCreated($teacher));
        $teacher->update(['invited' => true]);
        }
        // redirect back where we came from
        return redirect()->back()->with('success','Οι προσκήσεις στάλθηκαν επιτυχώς.');
    }

    public function accept($token)
    {
        if (!$invite = InviteTeacher::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        return view('auth.createPassword' , ['token' => $token] , ['invite' => $invite]);
    }

    public function update(Request $request ,InviteTeacher $teacher){
        $teacher->update(['name' => $request->name , 'surname' => $request->surname , 'email' => $request->email,  'job_role_id' => $request->job_role, 'tmima' => $request->domain]);

//        return redirect()->back();
        return redirect()->route('teacher.invite')->with('success','Τα στοιχεία του χρήστη ενημερώθηκαν επιτυχώς.');
    }

    public function show(InviteTeacher $teacher){
        $domains = Domain::all();
        $job_roles = JobRole::all();

        return view('admin.invited.editTeacher' , ['domains' => $domains , 'teacher' => $teacher, 'job_roles' => $job_roles]);
    }

    public function delete(InviteTeacher $teacher){
        $teacher->delete();
        return redirect()->back()->with('success','Ο χρήστης διαγράφηκε επιτυχώς.');

    }
}
