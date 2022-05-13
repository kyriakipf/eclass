@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p class="header">Welcome, {{auth()->user()->name}}.</p>
{{--        <hr>--}}
        <div class="card-container row">
            <div class="card-body col-md-5">
                <p class="title">Εγγεγραμένοι Φοιτητές</p>
                @livewire('student-list', [ 'users' => $students])
            </div>
            <div class="card-body col-md-5">
                <p class="title">Εγγεγραμένοι Καθηγητές</p>
                @livewire('teacher-list', [ 'users' => $teachers])
            </div>
        </div>
    </div>
@endsection
