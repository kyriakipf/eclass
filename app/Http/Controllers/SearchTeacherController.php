<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchTeacherController extends Controller
{
    public function searchIndex()
    {
        $domains = Domain::all();

        return view('admin.search.teachersIndex', ['domains' => $domains, 'teachers' => []]);
    }

    public function search(Request $request)
    {
        $domains = Domain::all();
        $userQuery = User::query();
        $users = [];
        if ($request->domain || $request->search) {
            if ($request->search) {
                $userQuery->where('role_id', '=', 2)
                    ->where('tmima','=',auth()->user()->tmima)
                ->where(function (Builder $query) use ($request) {
                    return $query->where('name', 'like', "%".$request->search."%")
                        ->orWhere('surname', 'like', "%".$request->search."%")
                        ->orWhere('email', 'like', "%".$request->search."%");
                });


            }
            $users = $userQuery->get();


            if (count($users) > 0) {
                return view('admin.search.teachers', ['domains' => $domains,  'users' => $users]);
            }else {
                return view('admin.search.teachers', ['domains' => $domains, 'users' => []]);
            }

        } else {
            return view('admin.search.teachers', ['domains' => $domains, 'users' => []]);
        }

    }
}
