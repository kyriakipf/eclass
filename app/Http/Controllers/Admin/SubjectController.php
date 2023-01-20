<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use function Livewire\str;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(5);

        return view('admin.subjects.manageSubjects', ['subjects' => $subjects]);
    }

    public function show(Subject $subject)
    {
        $users = $subject->teacher;
        $teacherIds = SubjectTeacher::getTeacherIds($subject);
        $homeworks = $subject->homework;
        $path = 'public' . DIRECTORY_SEPARATOR . $subject->directory . DIRECTORY_SEPARATOR . 'Ύλη';
        $folders = Storage::directories($path);
        $files = $subject->files;

        return view('admin.subjects.showSubject', ['users' => $users, 'subject' => $subject, 'teacherIds' => $teacherIds, 'homeworks' => $homeworks, 'folders' => $folders, 'files' => $files]);
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
//        dd($files);
        return view('admin.subjects.showSubjectDirectory', ['subfolders' => $subfolders, 'files' => $files, 'subject' => $subject, 'folder' => $folderpath, 'users' => $users, 'sizes' => $sizes]);
    }

    public function fileDownload(Subject $subject, $fileName)
    {

        $file = File::query()->where('subject_id', '=', $subject->id)->where('filename', '=', $fileName)->first();

        return Storage::download($file->filepath . '/' . $fileName);
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
            if ($file->filepath == $path)
            {
                $files->push($file);
                $file_size = Storage::size('public' . DIRECTORY_SEPARATOR . $file->filepath . DIRECTORY_SEPARATOR . $file->filename);
                $sizes [] = number_format($file_size / 1024, 2);


            }
        }
        return view('admin.subjects.showFiles', ['files' => $files, 'folders' => $folders, 'subject' => $subject, 'users' => $users, 'sizes' => $sizes]);
    }
}
