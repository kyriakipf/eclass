<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    protected $fillable=[
        'student_id',
        'group_id'
    ];
    use HasFactory;
}
