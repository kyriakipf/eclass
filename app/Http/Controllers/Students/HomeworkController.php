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
        $filepath = 'public' . DIRECTORY_SEPARATOR . auth()->user()->role->role_name . DIRECTORY_SEPARATOR . auth()->user()->email . DIRECTORY_SEPARATOR . $homework->subject->title . DIRECTORY_SEPARATOR . 'Εργασίες' . DIRECTORY_SEPARATOR . $homework->homework_type;
        $file = $student->homework()->where('homework_id', '=', $homeworkId)->first();
        $selfFile = null;
        if ($file != null)
        {
            $selfFile = $file->pivot->filename;
        }
        return view('student.homework.showHomework', ['homework' => $homework, 'filepath' => basename($filepath), 'selfFile' => $selfFile]);
    }

    public function fileDownload(Homework $homework)
    {
        return Storage::download($homework->filepath);
    }

    public function fileStore(Request $request, Homework $homework)
    {
        $studentId = auth()->user()->student->id;
        $hw = Homework::query()->whereRelation('students','student_id', '=', $studentId)->whereRelation('students','homework_id', '=', $homework->id)->first();
        try
        {
            if (!is_null($hw))
            {
                $hw->students()->detach($studentId);
            }

            $file = $request->file('file');

            $file_path ='public' . DIRECTORY_SEPARATOR . strtolower(auth()->user()->role->role_name) . DIRECTORY_SEPARATOR . auth()->user()->email . DIRECTORY_SEPARATOR . $homework->subject->title . DIRECTORY_SEPARATOR . $homework->title;


            $filename = $file->getClientOriginalName();
            $this->fileUploadRepository->fileUpload($file, $filename, $file_path);
            $this->homeworkRepository->createStudentRelation($homework, $studentId, $file_path, $filename);
        }
        catch (\Exception $e)
        {
            return redirect()->route('student.homework.show', ['homework' => $homework, 'subject' => $homework->subject])->with('error','Υπήρξε πρόβλημα με την μεταφόρτωση του αρχείου');
        }



        return redirect()->route('student.homework.show', ['homework' => $homework, 'subject' => $homework->subject])->with('success','Το αρχείο ανέβηκε επιτυχώς');
    }

    public function selfFileDownload(Homework $homework)
    {
        $student = auth()->user()->student;

        $file = $student->homework()->where('homework_id', '=', $homework->id)->first();
        $filepath = null;
        if ($file != null)
        {
            $filepath = $file->pivot->filepath;
        }
        return Storage::download($filepath);
    }
}
