<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    public function getAll()
    {
        $domain = auth()->user()->domain_id;
        $subjects = Subject::query()->where('tmima', '=' , $domain)->get();

        return view('student.subjects.allSubjects', ['subjects' => $subjects]);
    }

    public function registerForm()
    {
        $domain = auth()->user()->domain_id;
        $subjects = Subject::query()->where('tmima', '=' , $domain)->get();

        return view('student.subjects.subjectRegisterForm', ['subjects' => $subjects]);
    }

    public function index()
    {
        $userId = auth()->user()->student->id;
        $subjects = Subject::query()->whereRelation('student','student_id','=', $userId)->get();

        return view('student.subjects.manageSubjects', ['subjects' => $subjects]);
    }

    public function show(Subject $subject)
    {
        $users = User::getRelatedTeachers();
        $teacherIds = SubjectTeacher::getTeacherIds($subject);
        $homeworks = Subject::getRelatedHomework(auth()->user()->id);
        $path = $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη';
        $folders = Storage::directories($path);
        $files = Storage::files($path);

        return view('student.subjects.showSubject', ['users' => $users, 'subject' => $subject, 'teacherIds' => $teacherIds, 'homeworks' => $homeworks, 'folders' => $folders, 'files' => $files]);
    }
}
