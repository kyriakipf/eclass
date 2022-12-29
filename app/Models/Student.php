<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    protected $guard = 'student';
    protected $fillable = [
        'user_id',
        'am',
        'phone',
        'address',
        'profile_image',
        'profile_image_path',
        'member_since'
    ];

    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class, 'subject_students', 'student_id', 'subject_id')->withTimestamps();
    }

    public function homework()
    {
       return $this->belongsToMany(Homework::class, 'homework_student', 'student_id', 'homework_id')->withPivot('filename', 'filepath')->withTimestamps();
    }
}
