<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use Illuminate\Http\Request;
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
        $subjects = Subject::query()->whereRelation('student', 'student_id', '=', $userId)->get();

        return view('student.subjects.manageSubjects', ['subjects' => $subjects]);
    }

    public function show(Subject $subject)
    {
        $users = User::getRelatedTeachers();
        $teacherIds = SubjectTeacher::getTeacherIds($subject);
        $homeworks = Subject::getRelatedHomework(auth()->user()->id);
        $path = $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη';
        $folders = Storage::directories($path);
        $files = Storage::files($path);

        return view('student.subjects.showSubject', ['users' => $users, 'subject' => $subject, 'teacherIds' => $teacherIds, 'homeworks' => $homeworks, 'folders' => $folders, 'files' => $files]);
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
        return view('student.subjects.showSubjectDirectory', ['subfolders' => $subfolders, 'files' => $files, 'subject' => $subject, 'folder' => basename($folderpath)]);
    }

    public function fileDownload(Subject $subject, $fileName)
    {

        $file = File::query()->where('subject_id', '=', $subject->id)->where('filename', '=', $fileName)->first();

        return Storage::download($file->filepath . '/' . $fileName);
    }
}
