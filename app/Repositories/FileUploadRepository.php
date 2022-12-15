<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

class FileUploadRepository
{

    /**
     * File upload to storage with path and name
     * @param $file
     * @return void
     */
    public function fileUpload($file, $filename, $file_path)
    {
         $file->storeAs($file_path,$filename);
    }
}
