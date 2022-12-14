<?php

namespace App\Http\Livewire;

use App\Models\Homework;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Livewire\Component;

class EventsCalendar extends LivewireCalendar
{
    public function events() : \Illuminate\Support\Collection
    {
        return Homework::all();
    }
}
