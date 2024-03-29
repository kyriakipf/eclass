<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\InviteStudent;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::getRelatedStudents();
        $domains =Domain::all();
        return view('admin.registered.manageStudent', ['users'=> $students],  ['domains' => $domains]);
    }

    public function create(User $user){
        return view('auth.createPassword' , ['user' => $user]);
    }

    public function store(Request $request, InviteStudent $invite)
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
            'password' => $pass,
            'domain_id' => $invite->tmima,
            'role_id' => 3
        ]);
        $user->save();

        $student = new Student([
            'user_id'=>$user->id,
            'am'=>$invite->am,
        ]);
        $student->save();
        $invite->delete();

        return Redirect('/');
    }

    public function show(User $student){
        $domains = Domain::all();

        return view('admin.registered.editStudent' , ['domains' => $domains , 'student' => $student]);
    }

    public function update(Request $request ,User $student){
        $request->validate(
            ['email' => 'required|email'],
            ['email.email' => 'Το email δεν έχει την σωστή μορφή.']
        );

        $student->student->update(['am' => $request->am]);
        $student->update(['domain_id' => $student->domain_id ,'name' => $request->name , 'surname' => $request->surname , 'email' => $request->email]);

        return redirect()->route('students')->with('success','Τα στοιχεία του χρήστη ενημερώθηκαν επιτυχώς.');
    }

    public function delete(User $student){
        $student->student->delete();
        $student->delete();
        return redirect()->back()->with('success','Ο χρήστης διαγράφηκε επιτυχώς.');

    }
}
