<?php

namespace App\Repositories;

use App\Models\Homework;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class HomeworkRepository
{

    public function getAllRelatedToTeacher(int $teacherId)
    {
        return Homework::query()->where('uploaded_by', '=' , $teacherId)->get();
    }

    public function store(array $data)
    {
        $user = auth()->user()->id;
        $homework = null;
        $homework_type = 'Μαθήματος';
        if($data['homework_type'] == 1)
        {
            $homework_type = 'Εργαστηριακή';
        }

        DB::beginTransaction();
        try
        {

            $homework = Homework::create
            ([
                'subject_id' => $data['subject_id'],
                'uploaded_by' => $user,
                'title' => $data['title'],
                'summary' => $data['summary'],
                'due_date' => $data['due_date'],
                'max_grade' => $data['max_grade'],
                'start_date' => $data['start_date'],
                'homework_type' => $homework_type,
              'filepath' => 'test'
            ]);

            DB::commit();
        }
        catch (\Exception $e)
        {
//            dd($e);
            DB::rollback();
        }

        return $homework;
    }
}
