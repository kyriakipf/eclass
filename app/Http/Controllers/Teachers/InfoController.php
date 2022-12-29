<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function show()
    {
        return view('teacher.Info.showInfo');
    }


    public function edit()
    {
        return view('teacher.info.editInfo');
    }


    public function update(Request $request)
    {

    }

}
