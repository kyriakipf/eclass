<?php

namespace App\Repositories;

use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupRepository
{

    public function getAll()
    {
        return Group::all();
    }

    public function store($input)
    {
        DB::beginTransaction();

        try {
            Group::create([
                'subject_id' => $input['subjectId'],
                'title' => $input['title'],
                'summary' => $input['summary'],
                'capacity' => $input['capacity']
            ]);

            DB::commit();

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
        }
    }
}
