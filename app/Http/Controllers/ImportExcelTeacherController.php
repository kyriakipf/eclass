<?php

namespace App\Http\Controllers;

use App\Imports\TeachersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Validators\Failure;

class ImportExcelTeacherController extends Controller
{
    public function import(Request $request)
    {

        $import = new TeachersImport();
        $import->import($request->file('teachers'));

        $errorRow = [];

        foreach ($import->failures() as $failure) {
            $errorRow[] = $failure->row();
        }

        $errorString = implode(' ,', array_unique($errorRow));

        if ($import->failures()->count() != 0) {
            return redirect()->route('teacher.invite')->with('warning', 'Το αρχείο ανέβηκε επιτυχώς αλλά υπήρξε σφάλμα με τα στοιχεία των χρηστών στις γραμμές: '
                                                                              . $errorString .
                                                                             '. Ελέγξτε εάν είναι κενό κάποιο κελί ή εαν είναι ήδη εγγεγραμμένοι στο σύστημα.');

        }
        return redirect()->route('teacher.invite')->with('success', 'Το αρχείο ανέβηκε επιτυχώς.');
    }

}
