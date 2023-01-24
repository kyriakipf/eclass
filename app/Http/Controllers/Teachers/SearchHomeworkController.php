<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchHomeworkController extends Controller
{
    public function search(Request $request, Subject $subject = null)
    {
        $teacher = auth()->user()->teacher;

        if (!$subject)
        {
            $hwQuery = Homework::query()->where('uploaded_by', '=', auth()->user()->id);


        }else{
            $hwQuery = Homework::query()->whereRelation('subject', 'subject_id', '=', $subject->id);
        }

        if ($request->search) {
            if ($request->search) {
                $hwQuery->where(function (Builder $query) use ($request) {
                    return $query->where('title', 'like', "%".$request->search."%")
                        ->orWhere('summary', 'like', "%".$request->search."%")
                        ->orWhere('max_grade', 'like', "%".$request->search."%")
                        ->orWhere('due_date', 'like', "%".$request->search."%")
                        ->orWhere('homework_type', 'like', "%".$request->search."%");
                });


            }
            $homework = $hwQuery->get();


            if (count($homework) > 0) {
                return view('teacher.search.homework', ['homework' => $homework, 'subject' => $subject]);
            }else {
                return view('teacher.search.homework', ['homework' => [], 'subject' => $subject]);
            }

        } else {
            return view('teacher.search.homework', ['homework' => [], 'subject' => $subject]);
        }

    }
}
