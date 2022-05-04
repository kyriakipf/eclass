<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function invitedTeachers()
    {
        return $this->hasMany(InviteTeacher::class);
    }

    public function invitedStudents()
    {
        return $this->hasMany(InviteStudent::class);
    }
}
