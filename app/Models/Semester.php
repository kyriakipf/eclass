<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;


    public function subject()
    {
        return $this->hasMany(Subject::class);
    }

    public function getActive()
    {
        $semesters = Semester::all();

        $active = [];

        foreach ($semesters as $semester)
        {
            if ($this->isActive($semester))
            {
                $active []= $semester;
            }
        }

        return $active;
    }

    private function isActive($semester)
    {
        return Carbon::now()->between($semester->starts_at, $semester->ends_at);
    }
}
