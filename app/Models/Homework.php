<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $fillable = [
        'subject_id',
        'title',
        'summary',
        'due_date',
        'max_grade',
        'start_date',
        'homework_type',
        'filepath'
    ];

    use HasFactory;

    public function students()
    {
        return $this->belongsToMany(Student::class, 'homework_student', 'homework_id', 'student_id')->withPivot('filename', 'filepath')->withTimestamps();
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
