<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function show()
    {
        return view('student.Info.showInfo');
    }


    public function edit()
    {
        return view('student.info.editInfo');
    }


    public function update(Request $request)
    {
        try
        {
            $userId = auth()->user()->id;
            $studentId = auth()->user()->student->id;

            $user = User::find($userId);
            $student = Student::find($studentId);

            $user->update([
                'email' => $request->email,
                'name' => $request->name,
                'surname' => $request->surname
            ]);

            $student->update([
                'address' => $request->address,
                'phone' => $request->phone
            ]);
        }catch (\Exception $e)
        {
            return redirect()->back()->with('error','Υπήρξε πρόβλημα με την ενημέρωση των στοιχείων');
        }


        return redirect()->route( 'student.info.show')->with('success','Τα στοιχεία ενημερώθηκαν επιτυχώς');
    }

}
