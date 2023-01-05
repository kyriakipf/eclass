<?php

namespace App\Repositories;

use App\Models\Homework;
use App\Models\HomeworkStudent;
use Illuminate\Support\Facades\DB;

class HomeworkRepository
{

    public function getAllRelatedToTeacher(int $teacherId)
    {
        return Homework::query()->where('uploaded_by', '=', $teacherId)->get();
    }

    public function store(array $data, $file_path = null, $filename = null)
    {
        $user = auth()->user()->id;
        $homework = null;
        $path = null;

        if (!$file_path == null)
        {
            $path = $file_path . DIRECTORY_SEPARATOR . $filename;
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
                'homework_type' => $data['homework_type'],
                'filepath' => $path
            ]);

            DB::commit();
        } catch (\Exception $e)
        {
            DB::rollback();
        }

        return $homework;
    }

    public function update(array $data, Homework $homework, $file_path = null, $filename = null)
    {
        $path = null;

        if (!$file_path == null)
        {
            $path = $file_path . DIRECTORY_SEPARATOR . $filename;
        }

        $homework->update([
            'subject_id' => $data['subject_id'],
            'title' => $data['title'],
            'summary' => $data['summary'],
            'due_date' => $data['due_date'],
            'max_grade' => $data['max_grade'],
            'start_date' => $data['start_date'],
            'homework_type' => $data['homework_type'],
            'filepath' => $path
        ]);

        return $homework;
    }

    public function delete(Homework $homework)
    {
        $homework->delete();
    }

    public function removeFile(Homework $homework)
    {
        $homework->update([
          'filepath' => null
        ]);
    }

    public function createStudentRelation($homework, $studentId, string $file_path, string $filename)
    {
        $homework->students()->attach($studentId, [
            'filename' => $filename,
            'filepath' => $file_path . DIRECTORY_SEPARATOR . $filename
            ]);
    }
}
