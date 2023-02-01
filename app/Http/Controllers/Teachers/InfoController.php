<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function show()
    {
        return view('teacher.Info.showInfo');
    }


    public function edit()
    {
        return view('teacher.info.editInfo');
    }


    public function update(Request $request)
    {
        try
        {
            $userId = auth()->user()->id;
            $teacherId = auth()->user()->teacher->id;

            $user = User::find($userId);
            $teacher = Teacher::find($teacherId);

            $user->update([
                'email' => $request->email,
                'name' => $request->name,
                'surname' => $request->surname
            ]);

            $teacher->update([
                'idiotita' => $request->idiotita,
                'office_address' => $request->address,
                'phone' => $request->phone
            ]);
        }catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'Υπήρξε πρόβλημα με την ενημέρωση των στοιχείων');
        }

        return redirect()->route('teacher.info.show')->with('success','Τα στοιχεία ενημερώθηκαν επιτυχώς');
    }

}
