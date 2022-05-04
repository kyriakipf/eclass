<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    protected $guard = 'teacher';
    protected $fillable = [
    'user_id',
    'phone',
    'eidikotita',
    'idiotita',
    'office_address'
];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id', '=');
    }

}
