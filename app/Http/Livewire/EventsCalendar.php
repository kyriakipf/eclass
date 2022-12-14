<?php

namespace App\Http\Livewire;

use App\Models\Homework;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Livewire\Component;

class EventsCalendar extends LivewireCalendar
{
    public function events() : \Illuminate\Support\Collection
    {
        return Homework::query()->where('uploaded_by', '=', auth()->user()->id)->get()->map(function (Homework $homework){
            return [
                'id' => $homework->id,
                'title' => $homework->title,
                'description'=> $homework->summary,
                'date' => $homework->due_date
            ];
        });
    }
}
