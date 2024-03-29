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

    public function store($input, $subjectId)
    {
        DB::beginTransaction();

        try {
           $group =  Group::create([
                'subject_id' => $subjectId,
                'title' => $input['title'],
                'time' => $input['time'],
                'summary' => $input['summary'],
                'capacity' => $input['capacity']
            ]);

            DB::commit();

            return $group;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function update(array $data, Group $group, $subjectId)
    {
        $group->update([
            'subject_id' => $subjectId,
            'title' => $data['title'],
            'time' => $data['time'],
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
