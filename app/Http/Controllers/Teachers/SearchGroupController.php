<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchGroupController extends Controller
{
    public function search(Request $request, Subject $subject =  null)
    {
        $groupQuery = Group::query()->whereRelation('subject', 'subject_id', '=', $subject->id);
//            function ($query){
//            $query->whereRelation('teacher', 'user_id', '=', auth()->user()->id);
//        });

        if ($request->search) {
            if ($request->search) {
                $groupQuery->where(function (Builder $query) use ($request) {
                    return $query->where('title', 'like', "%".$request->search."%")
                        ->orWhere('summary', 'like', "%".$request->search."%");
                });


            }
            $groups = $groupQuery->get();


            if (count($groups) > 0) {
                return view('teacher.search.groups', ['groups' => $groups, 'subject' => $subject]);
            }else {
                return view('teacher.search.groups', ['groups' => [], 'subject' => $subject]);
            }

        } else {
            return view('teacher.search.groups', ['groups' => [], 'subject' => $subject]);
        }

    }
}
