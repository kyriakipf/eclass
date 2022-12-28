<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use App\Repositories\FileRepository;
use App\Repositories\FileUploadRepository;
use App\Repositories\SubjectRepository;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    protected $subjectRepository;
    protected $fileUploadRepository;
    protected $fileRepository;


    public function __construct(SubjectRepository $subjectRepository, FileUploadRepository $fileUploadRepository, FileRepository $fileRepository)
    {

        $this->subjectRepository = $subjectRepository;
        $this->fileUploadRepository = $fileUploadRepository;
        $this->fileRepository = $fileRepository;
    }


    public function index()
    {
        $subjects = Subject::all();

        return view('teacher.subjects.manageSubjects', ['subjects' => $subjects]);
    }

    public function create()
    {

        $users = User::getRelatedTeachers();
        $semesters = Semester::all();

        return view('teacher.subjects.createSubject', ['users' => $users, 'semesters' => $semesters]);
    }


    public function store(Request $request)
    {
        $public = false;
        $password = null;

        if (isset($request->public))
        {
            $public = true;
            $password = $request->password;
        }

        $request->validate([
            'title' => 'required',
            'teacherId' => 'required',
            'semester' => 'required'
        ]);

        $title = $request->title;
        $semester = $request->semester;
        $teacherId = $request->teacherId;
        $description = $request->description;
        $tmimaId = auth()->user()->tmima;
        $this->subjectRepository->storeSubject($title, $semester, $teacherId, $description, $tmimaId, $public, $password);

        return redirect()->back();
    }


    public function show(Subject $subject)
    {
        $users = User::getRelatedTeachers();
        $teacherIds = SubjectTeacher::getTeacherIds($subject);
        $homeworks = Subject::getRelatedHomework(auth()->user()->id);
        $path = $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη';
        $folders = Storage::directories($path);
        $files = Storage::files($path);

        return view('teacher.subjects.showSubject', ['users' => $users, 'subject' => $subject, 'teacherIds' => $teacherIds, 'homeworks' => $homeworks, 'folders' => $folders, 'files' => $files]);
    }


    public function edit(Subject $subject)
    {
        $users = User::getRelatedTeachers();
        $teacherIds = SubjectTeacher::getTeacherIds($subject);
        $semesters = Semester::all();

        return view('teacher.subjects.editSubject', ['users' => $users, 'subject' => $subject, 'teacherIds' => $teacherIds, 'semesters' => $semesters]);
    }


    public function update(Request $request, Subject $subject)
    {
        $password = null;
        $subject = Subject::find($subject->id);

        if ($request->public == "on")
        {
            $isPublic = true;
            $password = $request->password;
        }

        $subject->update([
            'title' => $request->title,
            'summary' => $request->description,
            'isPublic' => $isPublic,
            'password' => $password,
            'semester_id' => $request->semester
        ]);

        return redirect()->route('subject.show', $subject);
    }


    public function delete(Subject $subject)
    {
        $path = $subject->directory;
        Storage::deleteDirectory($path);
        $subject->delete();

        return redirect()->back()->with('success', 'Το μάθημα διαγράφηκε επιτυχώς.');

    }


    public function directoryCreate(Subject $subject)
    {
        return view('teacher.subjects.createSubjectDirectory', ['subject' => $subject]);
    }


    public function directoryStore(Subject $subject, Request $request)
    {
        $path = $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη' . DIRECTORY_SEPARATOR . $request->title;
        Storage::makeDirectory($path);

        return redirect()->route('subject.show', $subject);
    }


    public function directoryShow(Subject $subject, $folder)
    {
        $subjectPath = $subject->directory;
        $subjectFolders = Storage::allDirectories($subjectPath);

        $folderpath = '';

        foreach ($subjectFolders as $subjectFolder)
        {

            if (basename($subjectFolder) == $folder)
            {

                $folderpath = $subjectFolder;

            }
        }

        $subfolders = Storage::directories($folderpath);

        $files = Storage::files($folderpath);
        return view('teacher.subjects.showSubjectDirectory', ['subfolders' => $subfolders, 'files' => $files, 'subject' => $subject, 'folder' => basename($folderpath)]);
    }


    public function subDirectoryCreate(Subject $subject, $folder)
    {
        return view('teacher.subjects.createSubjectSubDirectory', ['subject' => $subject, 'folder' => $folder]);
    }


    public function subDirectoryStore(Subject $subject, $folder, Request $request)
    {
        $path = $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $request->title;
        Storage::makeDirectory($path);

        return redirect()->route('subject.directory.show', ['subject' => $subject, 'folder' => $folder]);
    }


    public function fileUpload(Subject $subject, $folder = null)
    {
        return view('teacher.subjects.uploadFile', ['subject' => $subject, 'folder' => $folder]);
    }


    public function fileStore(Subject $subject, $folder = null, Request $request)
    {
        $file = $request->file('file');
        $file_path = '';
        $subjectPath = $subject->directory;

        if (isset($file))
        {
            if ($folder != null)
            {

                $subjectFolders = Storage::allDirectories($subjectPath);

                foreach ($subjectFolders as $subjectFolder)
                {

                    if (basename($subjectFolder) == $folder)
                    {

                        $file_path = $subjectFolder;

                    }
                }
            } else
            {
                $file_path = $subjectPath . DIRECTORY_SEPARATOR . 'Ύλη';
            }
            $filename = $file->getClientOriginalName();
            $this->fileUploadRepository->fileUpload($file, $filename, $file_path);
            $this->fileRepository->create($subject, $file_path, $filename);
        }


        return redirect()->route('subject.show', ['subject' => $subject]);
    }


    public function fileDownload(Subject $subject, $fileName)
    {

        $file = File::query()->where('subject_id', '=', $subject->id)->where('filename', '=', $fileName)->first();

        return Storage::download($file->filepath . '/' . $fileName);
    }
}
