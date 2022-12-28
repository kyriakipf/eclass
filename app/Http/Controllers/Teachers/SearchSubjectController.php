<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchSubjectController extends Controller
{
    public function search(Request $request)
    {
        $teacher = auth()->user()->teacher;
        $subjectQuery = Subject::query();

        if ($request->domain || $request->search) {
            if ($request->search) {
                $subjectQuery->whereRelation('teacher','teacher_id', '=' , $teacher->id)->where(function (Builder $query) use ($request) {
                        return $query->where('title', 'like', "%".$request->search."%")
                            ->orWhere('summary', 'like', "%".$request->search."%");
                    });


            }
            $subjects = $subjectQuery->get();


            if (count($subjects) > 0) {
                return view('teacher.search.subjects', ['subjects' => $subjects]);
            }else {
                return view('teacher.search.subjects', ['subjects' => []]);
            }

        } else {
            return view('teacher.search.subjects', ['subjects' => []]);
        }

    }
}
