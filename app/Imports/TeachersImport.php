<?php

namespace App\Imports;

use App\Models\Domain;
use App\Models\InviteTeacher;
use App\Models\JobRole;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Facades\Excel;

class TeachersImport implements ToCollection, WithHeadingRow, WithValidation , SkipsOnFailure, SkipsEmptyRows
{
    use Importable, SkipsFailures;
    /**
     * @param Collection $collection
     */


    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            do {
                //generate a random string using Laravel's str_random helper
                $token = Str::random();
            } //check if the token already exists and if it does, try again
            while (InviteTeacher::where('token', $token)->first());
            $email = $row['email'];
            $idiotita = JobRole::query()->where('name', '=', $row['role'])->first();
            $user = InviteTeacher::query()->where('email', $email)->first();
            if (!$user) {
                InviteTeacher::updateOrCreate([
                    'email' => $email,
                    'name' => $row['name'],
                    'token' => $token,
                    'surname' => $row['surname'],
                    'tmima' => auth()->user()->domain->id,
                    'job_role_id' => $idiotita->id,
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
