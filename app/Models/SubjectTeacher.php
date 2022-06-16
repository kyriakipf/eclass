<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{

    protected $fillable =[
        'teacher_id',
        'subject_id'
    ];
    use HasFactory;

    public function getTeacherIds(Subject $subject){
        $teacherIds = SubjectTeacher::query()->where('subject_id', '=', $subject->id)->get('teacher_id');
        return $teacherIds;
    }
}
