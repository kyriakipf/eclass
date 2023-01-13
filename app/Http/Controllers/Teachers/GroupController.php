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


    public function create(Subject $subject)
    {
        return view('teacher.groups.createGroup', ['subject' => $subject]);
    }


    public function store(Request $request, Subject $subject)
    {
        $group = $this->groupRepository->store($request->input(), $subject->id);

        return redirect()->route('group.show', $group);
    }


    public function edit(Group $group, Subject $subject)
    {
        return view('teacher.groups.editGroup', ['group' => $group, 'subject' => $subject] );
    }


    public function update(Group $group, Request $request, Subject $subject)
    {
        $group = $this->groupRepository->update($request->all(),$group, $subject->id);

        $subject = $group->subject;
        $users = $subject->teacher;

        return view('teacher.groups.showGroup', ['group' => $group, 'users' => $users]);
    }


    public function show(Group $group)
    {
        $subject = $group->subject;
        $users = $subject->teacher;
        return view('teacher.groups.showGroup', ['group' => $group, 'users' => $users]);
    }

    public function delete(Group $group)
    {
        $subject = Subject::find($group->subject_id);
        $this->groupRepository->delete($group);

        return redirect()->route('subject.show',$subject);
    }
}
