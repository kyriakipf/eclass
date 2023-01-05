<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkStudent extends Model
{
    protected $fillable =[
        'homework_id',
        'student_id',
        'filename',
        'filepath'
    ];

    use HasFactory;
}
