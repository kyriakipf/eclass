@extends('layouts.teacher')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            {{auth()->user()->name}}
            {{auth()->user()->surname}}
            {{auth()->user()->email}}
            {{auth()->user()->teacher->phone}}
            {{auth()->user()->domain->name}}
            {{auth()->user()->teacher->job_role->name}}
            {{auth()->user()->teacher->office_address}}
            <a href="{{route('teacher.info.edit')}}">Επεξεργασία Προσωπικών Στοιχείων</a>
        </div>
    </div>
@endsection
