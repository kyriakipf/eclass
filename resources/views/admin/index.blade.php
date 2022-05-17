@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p class="header">Αρχική</p>
        <div class="card-container row">
            <div class="card-body col-md-4">
                <p class="title">Εγγεγραμένοι Φοιτητές</p>
                <div class="card-content">
                    @livewire('student-list', [ 'users' => $students])
                </div>
            </div>
            <div class="card-body col-md-4">
                <p class="title">Εγγεγραμένοι Καθηγητές</p>
                <div class="card-content">
                    @livewire('teacher-list', [ 'users' => $teachers])
                </div>
            </div>
            <div class="card-body col-md-4">
                <p class="title">Προσκεκλημένοι Φοιτητές</p>
                <div class="card-content">
                    @livewire('invite-students-list', [ 'users' => $invitedStudents])
                </div>
            </div>
            <div class="card-body col-md-4">
                <p class="title">Προσκεκλημένοι Καθηγητές</p>
                <div class="card-content">
                    @livewire('invite-teachers-list', [ 'users' => $invitedTeachers])
                </div>
            </div>
        </div>
    </div>
@endsection
