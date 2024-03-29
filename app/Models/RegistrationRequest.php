<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'eidikotita',
        'idiotita',
        'office_address',
        'phone',
        'tmima',
        'registration_type',
        'am'
    ];
}
