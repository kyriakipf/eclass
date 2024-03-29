<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'subject_id',
        'user_id',
        'filepath'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
