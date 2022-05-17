<?php

namespace App\Http\Livewire;

use App\Models\InviteStudent;
use Livewire\Component;

class InviteStudentsList extends Component
{
    public $sortField = 'surname';
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
        return view('livewire.invite-students-list', [
            'users' => InviteStudent::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
        ]);
    }
}
