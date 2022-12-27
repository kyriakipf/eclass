<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'summary',
        'semester_id' ,
        'isPublic' ,
        'password' ,
        'tmima'
    ];

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teachers', 'subject_id', 'teacher_id')->withTimestamps();
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
}
