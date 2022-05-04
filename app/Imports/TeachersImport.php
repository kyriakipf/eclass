<?php

namespace App\Imports;

use App\Models\Domain;
use App\Models\InviteTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Facades\Excel;

class TeachersImport implements ToCollection, WithHeadingRow, WithValidation , SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param Collection $collection
     */


//    public function import(Request $request)
//    {
//        try{
//            $import = Excel::import(new TeachersImport, $request->file('teachers'));
//
//        }catch (\Maatwebsite\Excel\Validators\ValidationException $e){
//
//            return redirect()->route('teacher.invite')->with('error','Υπήρξε κάποιο σφάλμα.');
//        }
//
//        foreach ($import->failures() as $failure) {
//            $failure->row(); // row that went wrong
//            $failure->attribute(); // either heading key (if using heading row concern) or column index
//            $failure->errors(); // Actual error messages from Laravel validator
//            $failure->values(); // The values of the row that has failed.
//        }
//
//        return redirect()->route('teacher.invite')->with('success','Το αρχείο ανέβηκε επιτυχώς.');
//    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), $this->rules())->validate();
        foreach ($rows as $row) {
            do {
                //generate a random string using Laravel's str_random helper
                $token = Str::random();
            } //check if the token already exists and if it does, try again
            while (InviteTeacher::where('token', $token)->first());
            $domain = Domain::where('name', '=' , $row['domain'])->first();
            $email = $row['email'];
            $user = InviteTeacher::query()->where('email', $email)->first();
            if (!$user) {
                InviteTeacher::updateOrCreate([
                    'email' => $email,
                    'name' => $row['name'],
                    'token' => $token,
                    'surname' => $row['surname'],
                    'tmima' => $domain->id,
                    'role_id' => 2
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required',
            '*.surname' => 'required',
            '*.email' => 'required|unique:users',
        ];
    }
}
