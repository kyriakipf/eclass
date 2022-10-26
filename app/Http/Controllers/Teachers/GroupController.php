<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subject;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    protected $groupRepository;
    protected $subjectRepository;


    public function __construct(GroupRepository $groupRepository, SubjectRepository $subjectRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->subjectRepository = $subjectRepository;
    }


    public function index()
    {
        return view('teacher.Groups.manageGroups', ['groups' => $this->groupRepository->getAll()]);
    }


    public function create()
    {
        return view('teacher.groups.createGroup', ['subjects' => $this->subjectRepository->getAll()]);
    }


    public function store(Request $request, $subjectId = null)
    {
        $group = $this->groupRepository->store($request->input());

        return redirect()->route('group.show', $group);
    }


    public function edit(Group $group)
    {
        return view('teacher.groups.editGroup', ['group' => $group, 'subjects' => $this->subjectRepository->getAll()] );
    }


    public function update(Group $group, Request $request)
    {
        $group = $this->groupRepository->update($request->all(),$group);

        return view('teacher.groups.showGroup', ['group' => $group]);
    }


    public function show(Group $group)
    {
        return view('teacher.groups.showGroup', ['group' => $group]);
    }

    public function delete(Group $group)
    {
        $subject = Subject::find($group->subject_id);
        $this->groupRepository->delete($group);

        return redirect()->route('subject.show',$subject);
    }
}
