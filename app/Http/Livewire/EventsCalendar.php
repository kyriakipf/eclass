<?php

namespace App\Http\Livewire;

use App\Models\Homework;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;
use Livewire\Component;

class EventsCalendar extends LivewireCalendar
{
    public function events() : \Illuminate\Support\Collection
    {
        $events = new Collection();
        switch (auth()->user()->role->role_name)
        {
            case 'Teacher':
                $subjects = auth()->user()->teacher->subject;
                break;
            case 'Student':
                $subjects = auth()->user()->student->subject;
                break;
        }

        foreach ($subjects as $subject)
        {
            $hw = Homework::query()->where('subject_id', '=', $subject->id)->first();

            if (isset($hw))
            {
                $events->push([
                    'id' => $hw->id,
                    'title' => $hw->title,
                    'description' => $hw->summary,
                    'date' => $hw->due_date
                ]);
            }
        }
        return $events;
    }
}
