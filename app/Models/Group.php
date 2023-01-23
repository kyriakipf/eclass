<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'summary',
        'time',
        'subject_id' ,
        'capacity' ,
    ];

    public function student()
    {
        return $this->belongsToMany(Student::class, 'group_students', 'group_id', 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
