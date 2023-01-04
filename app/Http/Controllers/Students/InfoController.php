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

        return view('student.Info.showInfo');
    }

}
