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
            'office_address' => $request->address
        ]);
        
        return view('teacher.Info.showInfo');
    }

}
