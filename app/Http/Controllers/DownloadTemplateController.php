<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;


class DownloadTemplateController extends Controller
{
    public function downloadTemplate($name)
    {

        $myFile = storage_path("app/public/templates/".$name.".xlsx");


        return response()->download($myFile);
    }
}
