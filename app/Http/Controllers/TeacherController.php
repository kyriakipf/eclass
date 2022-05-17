<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Invite;
use App\Models\InviteTeacher;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
        $pass = Hash::make($request->password);
        $user = new User([
            'email' => $invite->email,
            'name' => $invite->name,
            'surname' => $invite->surname,
            'role_id' => 2,
            'tmima' => $invite->tmima,
            'password' => $pass
        ]);
        $user->save();

        $teacher = new Teacher([
            'user_id'=>$user->id,
        ]);
        $teacher->save();
        // delete the invite so it can't be used again
        $invite->delete();

        return Redirect('/');
    }

    public function show(User $teacher){
        $domains = Domain::all();

        return view('admin.registered.editTeacher' , ['domains' => $domains , 'teacher' => $teacher]);
    }

    public function update(Request $request ,User $teacher){
        $teacher->update(['tmima' => $teacher->tmima,'name' => $request->name , 'surname' => $request->surname , 'email' => $request->email]);

        return redirect()->route('teachers')->with('success','Τα στοιχεία του χρήστη ενημερώθηκαν επιτυχώς.');
    }

    public function delete(User $teacher){
        $teacher->teacher->delete();
        $teacher->delete();
        return redirect()->back()->with('success','Ο χρήστης διαγράφηκε επιτυχώς.');
    }
}
