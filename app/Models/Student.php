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
        'am'
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


    public function homework()
    {
       return $this->belongsToMany(Homework::class, 'homework_student', 'student_id', 'homework_id')->withPivot('filename', 'filepath')->withTimestamps();
    }
}
