<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Subject;

class FileRepository
{

    public function create(Subject $subject, $file_path, string $filename)
    {
        File::create([
            'filename' => $filename,
            'subject_id' => $subject->id,
            'user_id' => auth()->user()->id,
            'filepath' => $file_path
        ]);
    }
}
