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
        'subject_id' ,
        'capacity' ,
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
