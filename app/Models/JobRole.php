<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
    use HasFactory;


    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function invitedTeachers()
    {
        return $this->hasMany(InviteTeacher::class);
    }
}
