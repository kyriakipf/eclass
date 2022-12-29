<?php

namespace App\Http\Controllers;

use App\Models\InviteStudent;
use App\Models\InviteTeacher;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Database\Seeders\SemesterSeeder;
use Dflydev\DotAccessData\Data;
use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        $students = Student::all();
        $invitedTeachers = InviteTeacher::all();
        $invitedStudents = InviteStudent::all();
        $subjects = Subject::all();
        $user = auth()->user();
        $activeSubs = $this->getCurrentSubjects(auth()->user()->role->role_name);

        if ($user->role_id == 1)
        {
            return view('admin.index', ['teachers' => $teachers, 'students' => $students, 'invitedTeachers' => $invitedTeachers, 'invitedStudents' => $invitedStudents, 'subjects' => $subjects]);
        } elseif ($user->role_id == 2)
        {
            return view('teacher.index', ['subjects' => $activeSubs]);
        } elseif ($user->role_id == 3)
        {
            $student = Student::query()->where('user_id', '=', auth()->user()->id)->first();
            return view('student.index', ['student' => $student]);
        } else
        {
            return view('login');
        }

    }


    private function getCurrentSubjects($role)
    {

        switch ($role)
        {
            case 'Teacher':
                $relation = 'teacher';
                $id = auth()->user()->teacher->id;
                break;
            case 'Student':
                $relation = 'student';
                $id = auth()->user()->student->id;
                break;
            default:
                return 'Unkown role';
        }

        $currMonth = Carbon::now()->month;
        $type = 'Εαρινό';

        if ($currMonth > 2 && $currMonth < 8)
        {
            $type = 'Χειμερινό';
        }

        return Subject::query()->whereRelation($relation, $relation . '_id', '=', $id)->whereRelation('semester', 'type', '=', $type)->get();
    }

}
