<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Repositories\HomeworkRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    protected $homeworkRepository;
    protected $subjectRepository;

    public function __construct(HomeworkRepository $homeworkRepository, SubjectRepository $subjectRepository)
    {
        $this->homeworkRepository = $homeworkRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        $homework = $this->homeworkRepository->getAllRelatedToTeacher($teacher->id);

        return view('teacher.homework.manageHomework', ['homework' => $homework]);
    }

    public function create()
    {
        $user = auth()->user();
        $subjects = $this->subjectRepository->getRelated($user->teacher);

        return view('teacher.homework.createHomework', ['subjects' => $subjects]);
    }

    public function store()
    {
        //todo
    }
}
