<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    protected $fillable =[
        'title',
        'summary',
        'semester_id' ,
        'ects',
        'type',
        'isPublic' ,
        'password' ,
        'tmima',
        'directory'
    ];

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teachers', 'subject_id', 'teacher_id')->withTimestamps();
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'subject_students', 'subject_id', 'student_id')->withTimestamps();
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'subject_id', 'id');
    }

    public function homework()
    {
        return $this->hasMany(Homework::class, 'subject_id', 'id');
    }

    public function getRelatedHomework($userId)
    {
        return Homework::query()->where('uploaded_by', '=', $userId)->get();
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
