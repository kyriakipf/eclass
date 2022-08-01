<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
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
        $this->groupRepository->store($request->input());
        return view('teacher.groups.manageGroups', ['groups' => $this->groupRepository->getAll(), 'subjectId' => $subjectId]);
    }
}
