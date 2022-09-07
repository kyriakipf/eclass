<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteStudent extends Model
{
    protected $fillable = [
        'email',
        'token',
        'name',
        'surname',
        'am',
        'role_id',
        'tmima',
        'invited'
    ];
    use HasFactory;

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'tmima', 'id', '=');
    }
}
