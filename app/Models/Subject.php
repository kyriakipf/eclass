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
        'semester' ,
        'isPublic' ,
        'password' ,
        'tmima'
    ];

    public function teacher(){
        return $this->belongsToMany(Teacher::class);
    }
}
