<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupStudent;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function register(Request $request)
    {
        $group = Group::find($request->id);

        $student = auth()->user()->student->id;


            GroupStudent::create([
                'group_id' => $request->id,
                'student_id' => $student
            ]);

            return response()->json('Εγγραφήκατε στην ομάδα ' . $group->title . '😇');
    }

    public function unregister(Request $request)
    {
        $group = Group::find($request->id);
        $student = auth()->user()->student->id;

        $relation = GroupStudent::query()->where('group_id', '=', $request->id)->where('student_id', '=', $student)->first();
        $relation->delete();

        return response()->json('Απεγγραφήκατε από την ομαδα ' . $group->title . ' 🤬');

    }
}
