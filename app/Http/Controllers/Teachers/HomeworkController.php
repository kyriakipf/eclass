<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Subject;
use App\Repositories\FileUploadRepository;
use App\Repositories\HomeworkRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter\AlignFormatter;

class HomeworkController extends Controller
{
    protected $homeworkRepository;
    protected $subjectRepository;
    protected $fileUploadRepository;


    public function __construct(HomeworkRepository $homeworkRepository, SubjectRepository $subjectRepository,FileUploadRepository $fileUploadRepository)
    {
        $this->homeworkRepository = $homeworkRepository;
        $this->subjectRepository = $subjectRepository;
        $this->fileUploadRepository = $fileUploadRepository;
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


    public function store(Request $request)
    {
        $file = $request->file('file');

        $subject = Subject::find($request->subject_id);
        if (isset($file)){
            $filename = $file->getClientOriginalName();
            $file_path = strtolower(auth()->user()->role->role_name) . DIRECTORY_SEPARATOR . auth()->user()->email . DIRECTORY_SEPARATOR . $subject->title . DIRECTORY_SEPARATOR . 'Εργασίες' . DIRECTORY_SEPARATOR .$request->homework_type;
            $this->fileUploadRepository->fileUpload($file,$filename, $file_path);
            $homework = $this->homeworkRepository->store($request->all(), $file_path, $filename);
        }else
        {
            $homework = $this->homeworkRepository->store($request->all());
        }

        return redirect()->route('homework.show', $homework);
    }


    public function show($homeworkId)
    {
        $homework = Homework::find($homeworkId);

        return view('teacher.homework.showHomework', ['homework' => $homework]);
    }


    public function edit(Homework $homework)
    {
        $user = auth()->user();
        $subjects = $this->subjectRepository->getRelated($user->teacher);

        return view('teacher.homework.editHomework', ['homework' => $homework, 'subjects' => $subjects]);
    }


    public function update(Request $request, Homework $homework)
    {
        $file = $request->file('file');

        if ($homework->filepath != null)
        {
            Storage::delete($homework->filepath);
        }

        $subject = Subject::find($request->subject_id);
        if (isset($file)){
            $filename = $file->getClientOriginalName();
            $file_path = strtolower(auth()->user()->role->role_name) . DIRECTORY_SEPARATOR . auth()->user()->email . DIRECTORY_SEPARATOR . $subject->title . DIRECTORY_SEPARATOR . 'Εργασίες' . DIRECTORY_SEPARATOR . $homework->homework_type;
            $this->fileUploadRepository->fileUpload($file,$filename, $file_path);
            $homework = $this->homeworkRepository->update($request->all(), $homework ,$file_path, $filename);
        }else
        {
            $homework = $this->homeworkRepository->update($request->all(), $homework);
        }

        return redirect()->route('homework.show', $homework);
    }


    public function delete(Homework $homework)
    {
        $subject = Subject::find($homework->subject_id);
        Storage::delete($homework->filepath);
        $this->homeworkRepository->delete($homework);

        return redirect()->route('subject.show',$subject);
    }

    public function deleteFile(Homework $homework)
    {
        Storage::delete($homework->filepath);
        $this->homeworkRepository->removeFile($homework);

        return redirect()->route('homework.show', $homework);
    }
}
