<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role_id',
        'tmima'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'tmima', 'id', '=');
    }

    public function homework()
    {
        return $this->hasOne(Homework::class);
    }

    public function getRelatedTeachers(){
        $domain = auth()->user()->tmima;
        $teachers = User::query()->where('tmima', '=',$domain)->where('role_id','=',2)->get();
        return $teachers;
    }

    public function getRelatedStudents(){
        $domain = auth()->user()->tmima;
        $students = User::query()->where('tmima','=',$domain)->where('role_id','=',3)->get();
        return $students;
    }
}
