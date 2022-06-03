<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;

class ImportExcelStudentController extends Controller
{
    public function import(Request $request)
    {

        $import = new StudentsImport();
        $import->import($request->file('students'));

        $errorRow = [];

        foreach ($import->failures() as $failure) {
            $errorRow[] = $failure->row();
        }

        $errorString = implode(' ,', array_unique($errorRow));
        if ($import->failures()->count() != 0) {
            return redirect()->route('student.invite')->with('warning', 'Το αρχείο ανέβηκε επιτυχώς αλλά υπήρξε σφάλμα με τα στοιχεία των χρηστών στις γραμμές: '
                                                                              . $errorString .
                                                                             '. Ελέγξτε εάν είναι κενό κάποιο κελί ή εαν είναι ήδη εγγεγραμμένοι στο σύστημα.');

        }
        return redirect()->route('student.invite')->with('success', 'Το αρχείο ανέβηκε επιτυχώς.');
    }

}
