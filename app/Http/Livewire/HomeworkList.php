<?php

namespace App\Http\Livewire;

use App\Models\Homework;
use Livewire\Component;
use Livewire\WithPagination;

class HomeworkList extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $sortField = 'title';
    public $sortAsc = true;
    public $search = '';

    public function sortBy($field)
    {
        $this->resetPage();
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $homework = Homework::query()->whereRelation('subject', function ($query){
            $query->whereRelation('teacher', 'user_id', '=', auth()->user()->id);
        })
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.homework-list', ['homework' => $homework]);
    }
}
