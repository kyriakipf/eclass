<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportExcelStudentController extends Controller
{
    public function import(Request $request)
    {
        try{
            Excel::import(new StudentsImport(), $request->file('students'));

        }catch (ValidationException $e){
            return redirect()->route('student.invite')->with('error','Υπήρξε κάποιο σφάλμα.');
        }
        return redirect()->route('student.invite')->with('success','Το αρχείο ανέβηκε επιτυχώς.');
    }
}
