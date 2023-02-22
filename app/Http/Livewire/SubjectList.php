<?php

namespace App\Http\Livewire;

use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectList extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $sortField = 'title';
    public $sortAsc = true;
    public $search = '';

    public function sortBy($field)
    {
        $this->resetPage();
        if ($this->sortField == $field)
        {
            $this->sortAsc = !$this->sortAsc;
        } else
        {
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
        $subjects = Subject::where('tmima', '=',auth()->user()->domain_id)
            ->whereRelation('teacher', 'user_id', '=', auth()->user()->id)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.subject-list',['subjects' => $subjects]);
    }
}
