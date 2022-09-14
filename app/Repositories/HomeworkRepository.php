<?php

namespace App\Repositories;

use App\Models\Homework;
use App\Models\Teacher;

class HomeworkRepository
{

    public function getAllRelatedToTeacher(int $teacherId)
    {
        return Homework::query()->where('uploaded_by', '=' , $teacherId)->get();
    }
}
