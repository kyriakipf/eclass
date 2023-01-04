<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'token',
        'name',
        'surname',
        'role_id',
        'tmima',
        'job_role_id',
        'invited'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'tmima', 'id', '=');
    }

    public function job_role()
    {
        return $this->belongsTo(JobRole::class);
    }
}
