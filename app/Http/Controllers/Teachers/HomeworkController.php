<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\FileUploadRepository;
use App\Repositories\HomeworkRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter\AlignFormatter;

class HomeworkController extends Controller
{
    protected $homeworkRepository;
    protected $subjectRepository;
    protected $fileUploadRepository;


    public function __construct(HomeworkRepository $homeworkRepository, SubjectRepository $subjectRepository, FileUploadRepository $fileUploadRepository)
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


    public function create(Subject $subject)
    {
        return view('teacher.homework.createHomework', ['subject' => $subject]);
    }


    public function store(Request $request, Subject $subject)
    {
        $file = $request->file('file');
        try
        {
            if (isset($file))
            {
                $filename = $file->getClientOriginalName();
                $file_path = 'public' . DIRECTORY_SEPARATOR . $subject->directory . DIRECTORY_SEPARATOR . 'Εργασίες' . DIRECTORY_SEPARATOR . $request->homework_type;
                $this->fileUploadRepository->fileUpload($file, $filename, $file_path);
                $homework = $this->homeworkRepository->store($request->all(), $subject->id, $file_path, $filename);
            } else
            {
                $homework = $this->homeworkRepository->store($request->all(), $subject->id);
            }
        }catch (\Exception $e)
        {
            return redirect()->back()->with('error','Υπήρξε πρόβλημα με την δημιουργία της εργασίας');
        }


        return redirect()->route('homework.show', ['homework' => $homework])->with('success', 'Η εργασία δημιουργήθηκε επιτυχώς');
    }


    public function show($homeworkId)
    {
        $homework = Homework::find($homeworkId);

        return view('teacher.homework.showHomework', ['homework' => $homework]);
    }


    public function edit(Homework $homework, Subject $subject)
    {
        return view('teacher.homework.editHomework', ['homework' => $homework, 'subject' => $subject]);
    }


    public function update(Request $request, Homework $homework, Subject $subject)
    {
        $file = $request->file('file');

        try
        {
            if ($homework->filepath != null)
            {
                Storage::delete($homework->filepath);
            }

            if (isset($file))
            {
                $filename = $file->getClientOriginalName();
                $file_path = 'public' . DIRECTORY_SEPARATOR . $subject->directory . DIRECTORY_SEPARATOR . 'Εργασίες' . DIRECTORY_SEPARATOR . $homework->homework_type;
                $this->fileUploadRepository->fileUpload($file, $filename, $file_path);
                $homework = $this->homeworkRepository->update($request->all(), $homework, $subject->id, $file_path, $filename);
            } else
            {
                $homework = $this->homeworkRepository->update($request->all(), $homework, $subject->id);
            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'Υπήρξε πρόβλημα με την ενημέρωση των στοιχείων της εργασίας');
        }


        return redirect()->route('homework.show', ['homework' => $homework, 'subject'=> $subject])->with('success','Τα στοιχεία της εργασίας ενημερώθηκαν επιτυχώς');
    }


    public function delete(Homework $homework)
    {
        $subject = Subject::find($homework->subject_id);
        Storage::delete('public' . DIRECTORY_SEPARATOR . $homework->filepath);
        $this->homeworkRepository->delete($homework);

        return redirect()->route('subject.show', $subject)->with('success','Η εργασία διαγράγηκε επιτυχώς');
    }

    public function deleteFile(Homework $homework)
    {
        Storage::delete('public' . DIRECTORY_SEPARATOR . $homework->filepath);
        $this->homeworkRepository->removeFile($homework);

        return redirect()->route('homework.show', $homework)->with('success', 'Το αρχείο διαγράφηκε επιτυχώς');
    }


    public function fileDownload(Homework $homework)
    {
        return Storage::download('public' . DIRECTORY_SEPARATOR . $homework->filepath);
    }

    public function studentFileDownload(Student $student, Homework $homework)
    {
        $file = $student->homework()->where('homework_id', '=', $homework->id)->first();
        $filepath = null;
        if ($file != null)
        {
            $filepath = $file->pivot->filepath;
        }
        return Storage::download($filepath);
    }
}
