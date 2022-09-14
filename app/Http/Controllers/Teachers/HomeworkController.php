<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Repositories\HomeworkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    protected $homeworkRepository;

    public function __construct(HomeworkRepository $homeworkRepository)
    {
        $this->homeworkRepository=$homeworkRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        $homework = $this->homeworkRepository->getAllRelatedToTeacher($teacher->id);

        return view('teacher.homework.manageHomework', ['homework' => $homework]);
    }
}
