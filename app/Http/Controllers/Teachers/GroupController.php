<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subject;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Database\Eloquent\Collection;
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
        $subjects = auth()->user()->teacher->subject;
        $groups = new Collection();

        foreach ($subjects as $subject)
        {
            $groups->push($subject->groups);
        }
        return view('teacher.Groups.manageGroups', ['groups' => $groups]);
    }


    public function create(Subject $subject)
    {
        return view('teacher.groups.createGroup', ['subject' => $subject]);
    }


    public function store(Request $request, Subject $subject)
    {
        try
        {
            $group = $this->groupRepository->store($request->input(), $subject->id);
        }catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'Υπήρξε πρόβλημα με την δημιοργία της ομάδας');
        }

        return redirect()->route('group.show', $group)->with('success', 'Η ομάδα δημιουργήθηκε επιτυχώς');
    }


    public function edit(Group $group, Subject $subject)
    {
        return view('teacher.groups.editGroup', ['group' => $group, 'subject' => $subject] );
    }


    public function update(Group $group, Request $request, Subject $subject)
    {
        try
        {
            $group = $this->groupRepository->update($request->all(),$group, $subject->id);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'Υπήρξε πρόβλημα με την ενημέρωση των στοιχείων της ομάδας');
        }

        $subject = $group->subject;
        $users = $subject->teacher;

        return view('teacher.groups.showGroup', ['group' => $group, 'users' => $users])->with('success','Τα στοιχεία ενημερώθηκαν επιτυχώς');
    }


    public function show(Group $group)
    {
        $subject = $group->subject;
        $users = $subject->teacher;
        $students = $group->student;
        return view('teacher.groups.showGroup', ['group' => $group, 'users' => $users, 'students' => $students]);
    }

    public function delete(Group $group)
    {
        $subject = Subject::find($group->subject_id);
        $this->groupRepository->delete($group);

        return redirect()->route('subject.show',$subject)->with('success','Η ομάδα διαγράφηκε επιτυχώς');
    }
}
