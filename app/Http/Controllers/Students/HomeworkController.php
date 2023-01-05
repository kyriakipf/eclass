<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Repositories\FileRepository;
use App\Repositories\FileUploadRepository;
use App\Repositories\HomeworkRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeworkController extends Controller
{
    protected $homeworkRepository;
    protected $fileUploadRepository;
    protected $fileRepository;


    public function __construct(HomeworkRepository $homeworkRepository, FileUploadRepository $fileUploadRepository, FileRepository $fileRepository)
    {

        $this->homeworkRepository = $homeworkRepository;
        $this->fileUploadRepository = $fileUploadRepository;
        $this->fileRepository = $fileRepository;
    }

    public function show($homeworkId)
    {
        $student = auth()->user()->student;
        $homework = Homework::find($homeworkId);
        $filepath = $student->homework()->where('homework_id', '=', $homeworkId)->first();
        if (!is_null($filepath))
        {
            $path = $filepath->pivot->filepath;
        }

        return view('student.homework.showHomework', ['homework' => $homework, 'filepath' => basename($path)]);
    }

    public function fileDownload(Homework $homework)
    {
        return Storage::download($homework->filepath);
    }

    public function fileStore(Request $request, Homework $homework)
    {
        $studentId = auth()->user()->student->id;
        $hw = Homework::query()->whereRelation('students','student_id', '=', $studentId)->whereRelation('students','homework_id', '=', $homework->id)->first();

        if (!is_null($hw))
        {
            $hw->students()->detach($studentId);
        }

        $file = $request->file('file');

        $file_path = strtolower(auth()->user()->role->role_name) . DIRECTORY_SEPARATOR . auth()->user()->email . DIRECTORY_SEPARATOR . $homework->subject->title . DIRECTORY_SEPARATOR . $homework->title;


        $filename = $file->getClientOriginalName();
        $this->fileUploadRepository->fileUpload($file, $filename, $file_path);
        $this->homeworkRepository->createStudentRelation($homework, $studentId, $file_path, $filename);


        return view('student.homework.showHomework', ['homework' => $homework, 'filepath' => $filename]);
    }

    public function selfFileDownload(Homework $homework)
    {
        $student = auth()->user()->student;

        $filepath = $student->homework()->where('homework_id', '=', $homework->id)->first()->pivot->filepath;

        return Storage::download($filepath);
    }
}
