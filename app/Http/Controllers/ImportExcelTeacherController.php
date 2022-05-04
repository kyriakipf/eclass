<?php

namespace App\Http\Controllers;

use App\Imports\TeachersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Validators\Failure;

class ImportExcelTeacherController extends Controller {
    public function import(Request $request)
    {
        try{
          $import = Excel::import(new TeachersImport, $request->file('teachers'));

        }catch (\Maatwebsite\Excel\Validators\ValidationException $e){

            return redirect()->route('teacher.invite')->with('error','Υπήρξε κάποιο σφάλμα.');
        }

//        foreach ($import->failures() as $failure) {
//            $failure->row(); // row that went wrong
//            $failure->attribute(); // either heading key (if using heading row concern) or column index
//            $failure->errors(); // Actual error messages from Laravel validator
//            $failure->values(); // The values of the row that has failed.
//        }

        return redirect()->route('teacher.invite')->with('success','Το αρχείο ανέβηκε επιτυχώς.');
    }
}
