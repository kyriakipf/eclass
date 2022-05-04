<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StudentList extends Component
{
    use WithPagination;

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

        $query= DB::table('users')->where('role_id', '=', 3)->where('tmima','=',auth()->user()->tmima)
            ->join('students', 'students.user_id', 'users.id');

        if($this->sortField == 'am'){
            $query->orderBy('students.am', $this->sortAsc ? 'asc' : 'desc')->select(['users.*','students.am']);
        }else
        {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->select('users.*');
        }

        $students = $query->get();

        $users = new \Illuminate\Database\Eloquent\Collection();
        foreach ($students as $student)
        {
            $user = User::find($student->id);
            $users->add($user->load('student'));

        }
        $items = $users->forPage($this->page, $this->perPage);

        $paginator = new LengthAwarePaginator($items, $users->count(), $this->perPage, $this->page);

        return view('livewire.student-list', [
            'users' => $paginator
        ]);
    }
}
