<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Repositories\HomeworkRepository;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    protected $homeworkRepository;

    public function __construct(HomeworkRepository $homeworkRepository)
    {
        $this->homeworkRepository=$homeworkRepository;
    }

    public function index()
    {
        $homework = $this->homeworkRepository->getAllRelatedToTeacher();

        return view('teacher.homework.manageHomework', ['homework' => $homework]);
    }
}
