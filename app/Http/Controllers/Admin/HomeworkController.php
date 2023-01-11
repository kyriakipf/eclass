<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeworkController extends Controller
{
    public function show(Homework $homework)
    {
        return view('admin.homework.showHomework' , ['homework' => $homework]);
    }

    public function fileDownload(Homework $homework)
    {
        return Storage::download($homework->filepath);
    }
}
