<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchStudentController extends Controller
{
    public function searchIndex()
    {
        $domains = Domain::all();

        return view('admin.search.studentsIndex', ['domains' => $domains, 'students' => []]);
    }

    public function search(Request $request)
    {
        $userQuery = User::query();
        $studentQuery = Student::query();
        $users = [];
        $students = [];
        if ($request->search) {
            if ($request->search) {
                $userQuery->where('role_id', '=', 3)
                    ->where('tmima', '=', auth()->user()->tmima)
                    ->where(function (Builder $query) use ($request) {
                        return $query->where('name', 'like', "%" . $request->search . "%")
                            ->orWhere('surname', 'like', "%" . $request->search . "%")
                            ->orWhere('email', 'like', "%" . $request->search . "%");
                    });
                $studentQuery->where('am', 'like', "%" . $request->search . "%");
                if ($studentQuery->count() > 0) {
                    $studentsTemp = $studentQuery->pluck('user_id');
                    $users = User::query()->where('tmima','=',auth()->user()->tmima)->whereIn('id', $studentsTemp)->get();
                } elseif ($userQuery->count() > 0) {
                    $users = $userQuery->get();
                }
            }

            if (count($users) > 0) {
                return view('admin.search.students', [ 'users' => $users]);
            } else {
                return view('admin.search.studentsIndex', ['users' => []]);
            }

        } else {
            return view('admin.search.studentsIndex', [ 'users' => []]);
        }

    }
}
