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

    public function storeSubject(string $title, string $semester, string $ects, string $type,string $description, int $tmimaId, bool $public, string $password = null)
    {
        DB::beginTransaction();

        try
        {
            $subject = Subject::create([
                'title' => $title,
                'summary' => $description,
                'semester_id' => $semester,
                'ects' => $ects,
                'type' => $type,
                'isPublic' => $public,
                'password' => $password,
                'tmima' => $tmimaId,
                'directory' => strtolower(auth()->user()->role->role_name) . DIRECTORY_SEPARATOR . auth()->user()->email . DIRECTORY_SEPARATOR . $title

            ]);

            $teacher = SubjectTeacher::create([
                'subject_id' => $subject->id,
                'teacher_id' => auth()->user()->teacher->id
            ]);

            DB::commit();
            // all good


        } catch (\Exception $e)
        {
            DB::rollback();
            // something went wrong
        }
        return $subject;
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
