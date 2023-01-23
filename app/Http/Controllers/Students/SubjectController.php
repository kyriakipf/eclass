<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Subject;
use App\Models\SubjectStudent;
use App\Models\SubjectTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    public function getAll()
    {
        $domain = auth()->user()->domain_id;
        $subjects = Subject::query()->where('tmima', '=', $domain)->get();

        return view('student.subjects.allSubjects', ['subjects' => $subjects]);
    }

    public function registerForm()
    {
        $domain = auth()->user()->domain_id;
        $subjects = Subject::query()->where('tmima', '=', $domain)->get();

        return view('student.subjects.subjectRegisterForm', ['subjects' => $subjects]);
    }

    public function index()
    {
        $userId = auth()->user()->student->id;
        $subjects = Subject::query()->whereRelation('student', 'student_id', '=', $userId)->paginate(5);

        return view('student.subjects.manageSubjects', ['subjects' => $subjects]);
    }

    public function show(Subject $subject)
    {
        $users = User::getRelatedTeachers();
        $teacherIds = SubjectTeacher::getTeacherIds($subject);
        $homeworks = Subject::getRelatedHomework(auth()->user()->id);
        $path = 'public' . DIRECTORY_SEPARATOR . $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη';
        $folders = Storage::directories($path);
        $files = Storage::files($path);

        return view('student.subjects.showSubject', ['users' => $users, 'subject' => $subject, 'teacherIds' => $teacherIds, 'homeworks' => $homeworks, 'folders' => $folders, 'files' => $files]);
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
        return view('student.subjects.showSubjectDirectory', ['subfolders' => $subfolders, 'files' => $files, 'subject' => $subject,  'folder' => $folderpath, 'users' => $users, 'sizes' => $sizes]);
    }

    public function fileDownload(Subject $subject, $fileName)
    {

        $file = File::query()->where('subject_id', '=', $subject->id)->where('filename', '=', $fileName)->first();

        return Storage::download('public' . DIRECTORY_SEPARATOR . $file->filepath . '/' . $fileName);
    }

    public function register(Request $request)
    {
        $subject = Subject::find($request->id);

        $student = auth()->user()->student->id;

        if (is_null($subject->password))
        {
            SubjectStudent::create([
                'subject_id' => $request->id,
                'student_id' => $student
            ]);

            return response()->json('Εγγραφήκατε στο μάθημα ' . $subject->title);
        }

        if ($subject->password == $request->pass)
        {
            SubjectStudent::create([
                'subject_id' => $request->id,
                'student_id' => $student
            ]);

            return response()->json('Εγγραφήκατε στο μάθημα ' . $subject->name );
        }

        return response()->json('Λάθος κωδικός')->setStatusCode('401');
    }

    public function unregister(Request $request)
    {
        $subject = Subject::find($request->id);
        $student = auth()->user()->student->id;

        $relation = SubjectStudent::query()->where('subject_id', '=', $request->id)->where('student_id', '=', $student)->first();
        $relation->delete();

        return response()->json('Απεγγραφήκατε από το μάθημα ' . $subject->name);

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
        return view('student.subjects.showFiles', ['files' => $files, 'folders' => $folders, 'subject' => $subject, 'users' => $users, 'sizes' => $sizes, 'fold' => null]);
    }

    public function homeworkShow(Subject $subject)
    {
        $homework = $subject->homework()->paginate(5);

        return view('student.subjects.showHomework', ['homework' => $homework, 'subject' => $subject]);
    }

    public function groupShow(Subject $subject)
    {
        $groups = $subject->groups()->paginate(5);

        return view('student.subjects.showGroups', ['groups' => $groups, 'subject' => $subject]);
    }

    public function emailShow(Subject $subject)
    {
        $emails = $subject->message()->paginate(5);

        return view('student.subjects.showEmail', ['emails' => $emails, 'subject' => $subject]);
    }
}
