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
           $group =  Group::create([
                'subject_id' => $input['subjectId'],
                'title' => $input['title'],
                'summary' => $input['summary'],
                'capacity' => $input['capacity']
            ]);

            DB::commit();

            return $group;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function update(array $data, Group $group)
    {
        $group->update([
            'subject_id' => $data['subjectId'],
            'title' => $data['title'],
            'summary' => $data['summary'],
            'capacity' => $data['capacity']
        ]);

        return $group;
    }

    public function delete(Group $group)
    {
        $group->delete();
    }
}
