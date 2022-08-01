<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectRepository;
    public function __construct(SubjectRepository $subjectRepository){
        $this->subjectRepository=$subjectRepository;
    }

    public function index()
    {
        $subjects = Subject::all();
        return view('teacher.subjects.manageSubjects', ['subjects' => $subjects]);
    }

    public function create()
    {

        $users= User::getRelatedTeachers();
        return view('teacher.subjects.createSubject' ,['users' => $users]);
    }

    public function store(Request $request)
    {
        $public = false;
        $password = null;
        if(isset($request->public))
        {
            $public = true;
            $password = $request->password;
        }
        $request->validate([
            'title' => 'required',
            'teacherId' => 'required',
            'semester' => 'required'
        ]);
        $title= $request->title;
        $semester = $request->semester;
        $teacherId = $request->teacherId;
        $description = $request->description;
        $tmimaId = auth()->user()->tmima;

        $this->subjectRepository->storeSubject($title,$semester,$teacherId,$description,$tmimaId,$public,$password);
        return redirect()->back();
    }

    public function show(Subject $subject)
    {
        $users= User::getRelatedTeachers();
        $teacherIds = SubjectTeacher::getTeacherIds($subject);
        return view('teacher.subjects.editSubject' ,['users' => $users, 'subject' => $subject, 'teacherIds' => $teacherIds]);
    }

    public function update(Request $request, Subject $subject)
    {
        $password = null;
        $subject = Subject::find($subject->id);
        if($request->public == "on")
        {
            $isPublic = true;
            $password = $request->password;
        }
        $subject->update([
            'title' => $request->title,
            'summary' => $request->description,
            'isPublic' => $isPublic,
            'password' => $password,
            'semester' => $request->semester
        ]);
        return redirect()->route('subjects');
    }

}
