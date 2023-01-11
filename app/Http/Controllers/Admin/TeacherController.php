<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Invite;
use App\Models\InviteTeacher;
use App\Models\JobRole;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $domains =Domain::all();
        $teachers = User::getRelatedTeachers();
        return view('admin.registered.manageTeacher', ['domains' => $domains, 'teachers' =>$teachers]);
    }

    public function create(User $user){
        return view('auth.createPassword' , ['user' => $user]);
    }
    public function store(Request $request, InviteTeacher $invite)
    {
        if ($request->password != $request->confirmPassword)
        {
            return redirect()->back()->with('error','Οι κωδικοί δεν ταιριάζουν.');
        }

        $pass = Hash::make($request->password);
        $user = new User([
            'email' => $invite->email,
            'name' => $invite->name,
            'surname' => $invite->surname,
            'role_id' => 2,
            'domain_id' => $invite->tmima,
            'password' => $pass
        ]);
        $user->save();

        $teacher = new Teacher([
            'user_id'=>$user->id,
            'job_role_id' => $invite->job_role_id,
        ]);
        $teacher->save();
        // delete the invite so it can't be used again
        $invite->delete();

        return Redirect('/');
    }

    public function show(User $teacher){
        $domains = Domain::all();
        $job_roles = JobRole::all();

        return view('admin.registered.editTeacher' , ['domains' => $domains , 'teacher' => $teacher, 'job_roles' => $job_roles]);
    }

    public function update(Request $request ,User $user){
        $request->validate(
            ['email' => 'required|email'],
            ['email.email' => 'Το email δεν έχει την σωστή μορφή.']
        );

        $user->update(['domain_id' => $user->domain_id,'name' => $request->name , 'surname' => $request->surname , 'email' => $request->email]);
        $teacher =  Teacher::query()->where('user_id', '=', $user->id)->first();
        $teacher->update(['job_role_id' => $request->job_role]);

        return redirect()->route('teachers')->with('success','Τα στοιχεία του χρήστη ενημερώθηκαν επιτυχώς.');
    }

    public function delete(User $teacher){
        $teacher->teacher->delete();
        $teacher->delete();
        return redirect()->back()->with('success','Ο χρήστης διαγράφηκε επιτυχώς.');
    }
}
