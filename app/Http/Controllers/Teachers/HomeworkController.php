<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    protected $homeworkRepository;
    public function __construct(HomeworkRepository $homeworkRepository){
        $this->homeworkRepository=$homeworkRepository;
    }
}
