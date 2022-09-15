<?php

namespace App\Repositories;

use App\Models\Homework;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubjectRepository
{

    public function storeSubject(string $title, string $semester, int $teacherId, string $description,int $tmimaId, bool $public, string $password = null){
        DB::beginTransaction();

        try {
         $subject =  Subject::create([
                'title'=> $title,
                'summary'=> $description,
                'semester' => $semester,
                'isPublic' => $public,
                'password' => $password,
                'tmima' => $tmimaId

            ]);

           $teacher = SubjectTeacher::create([
                'subject_id' => $subject->id,
                'teacher_id' => $teacherId
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
//            dd($e);
            DB::rollback();
            // something went wrong
        }
    }

    public function getAll()
    {
        return Subject::all();
    }

    public function getRelated(Teacher $teacher)
    {
        $subjects = $teacher->subject;

        return $subjects;
    }


}
