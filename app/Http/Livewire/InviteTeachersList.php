<?php

namespace App\Http\Livewire;

use App\Models\InviteTeacher;
use Livewire\Component;

class InviteTeachersList extends Component
{
    public $perPage = 5;
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
        return view('livewire.invite-teachers-list', [
            'users' => InviteTeacher::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
        ]);
    }
}
