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
use Illuminate\Support\Collection;
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
            'semester' => 'required'
        ]);

        $title = $request->title;
        $semester = $request->semester;
        $description = $request->description;
        $tmimaId = auth()->user()->domain_id;
        $subject = $this->subjectRepository->storeSubject($title, $semester, $description, $tmimaId, $public, $password);

        return redirect()->route('subject.show', $subject);
    }


    public function show(Subject $subject)
    {
        $users = $subject->teacher;
        $homeworks = $subject->homework;
        $path = 'public' . DIRECTORY_SEPARATOR . $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη';
        $folders = Storage::directories($path);
        $files = Storage::files($path);

        return view('teacher.subjects.showSubject', ['users' => $users, 'subject' => $subject, 'homeworks' => $homeworks, 'folders' => $folders, 'files' => $files]);
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
        $subject = Subject::find($subject->id);
        $isPublic = $subject->isPublic;
        $password = $subject->password;

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
        $path = 'public' . DIRECTORY_SEPARATOR . $subject->directory;
        Storage::deleteDirectory($path);
        $subject->delete();

        return redirect()->back()->with('success', 'Το μάθημα διαγράφηκε επιτυχώς.');

    }


    public function directoryStore(Subject $subject, Request $request)
    {
        $path = 'public' . DIRECTORY_SEPARATOR . $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη' . DIRECTORY_SEPARATOR . $request->title;
        Storage::makeDirectory($path);

        return redirect()->back();
    }


    public function directoryShow(Subject $subject, $folder)
    {
        $subjectPath = $subject->directory;
        $users = $subject->teacher;
        $subjectFolders = Storage::allDirectories('public' . DIRECTORY_SEPARATOR . $subjectPath);

        $folderpath = '';

        foreach ($subjectFolders as $subjectFolder)
        {

            if (basename($subjectFolder) == $folder)
            {

                $folderpath = $subjectFolder;

            }
        }

        $subfolders = Storage::directories($folderpath);

        $files = new Collection();
        $sizes = [];

        foreach ($subject->files as $file)
        {
            if ('public' . DIRECTORY_SEPARATOR . $file->filepath == str_replace('/', '\\', $folderpath))
            {
                $files->push($file);
                $file_size = Storage::size('public' . DIRECTORY_SEPARATOR . $file->filepath . DIRECTORY_SEPARATOR . $file->filename);
                $sizes [] = number_format($file_size / 1024, 2);

            }
        }
        return view('teacher.subjects.showSubjectDirectory', ['subfolders' => $subfolders, 'files' => $files, 'subject' => $subject, 'folder' => $folderpath, 'users' => $users, 'sizes' => $sizes]);
    }


    public function subDirectoryStore(Subject $subject, $folder, Request $request)
    {
        $path = $folder . DIRECTORY_SEPARATOR . $request->title;
        Storage::makeDirectory($path);

        return redirect()->back();
    }


    public function fileStore(Subject $subject, $folder = null, Request $request)
    {
        $file = $request->file('file');
        $file_path = '';
        $subjectPath = 'public' . DIRECTORY_SEPARATOR . $subject->directory;
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
        return redirect()->back();
    }


    public function fileDownload(Subject $subject, $fileName)
    {

        $file = File::query()->where('subject_id', '=', $subject->id)->where('filename', '=', $fileName)->first();

        return Storage::download('public' . DIRECTORY_SEPARATOR . $file->filepath . '/' . $fileName);
    }

    public function fileShow(Subject $subject)
    {
        $users = $subject->teacher;
        $path = $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη';
        $folders = Storage::directories('public' . DIRECTORY_SEPARATOR . $path);
        $files = new Collection();
        $sizes = [];
        foreach ($subject->files as $file)
        {
            if ($file->filepath ==  $path)
            {
                $files->push($file);
                $file_size = Storage::size('public' . DIRECTORY_SEPARATOR . $file->filepath . DIRECTORY_SEPARATOR . $file->filename);
                $sizes [] = number_format($file_size / 1024, 2);


            }
        }
        return view('teacher.subjects.showFiles', ['files' => $files, 'folders' => $folders, 'subject' => $subject, 'users' => $users, 'sizes' => $sizes, 'fold' => null]);
    }

    public function homeworkShow(Subject $subject)
    {
        $homework = $subject->homework;

        return view('teacher.subjects.showHomework', ['homework' => $homework, 'subject' => $subject]);
    }

    public function groupShow(Subject $subject)
    {
        $groups = $subject->groups;

        return view('teacher.subjects.showGroups', ['groups' => $groups, 'subject' => $subject]);
    }
}
