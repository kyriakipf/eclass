<?php

namespace App\Imports;

use App\Models\Domain;
use App\Models\InviteStudent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToCollection, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable,SkipsFailures;
    /**
     * @param Collection $collection
     */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            do {
                $token = Str::random();
            }while (InviteStudent::where('token', $token)->first()); //check if the token already exists and if it does, try again
            $email = $row['email'];
            $user = InviteStudent::query()->where('email', $email)->first();
            if (!$user) {
                InviteStudent::create([
                    'email' => $email,
                    'name' => $row['name'],
                    'surname' => $row['surname'],
                    'token' => $token,
                    'am' => $row['am'],
                    'tmima' => auth()->user()->domain->id,
                    'role_id' => 3
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
            '*.am' => 'required|unique:students'
        ];
    }
}

