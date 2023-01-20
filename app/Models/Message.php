<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'subject',
        'message',
        'send_date',
        'subject_id'
    ];

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
