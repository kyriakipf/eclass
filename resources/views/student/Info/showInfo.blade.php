@extends('layouts.student')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            {{auth()->user()->name}}
            {{auth()->user()->surname}}
            {{auth()->user()->email}}
            {{auth()->user()->domain->name}}
            {{auth()->user()->student->address}}
            {{auth()->user()->student->phone}}
            <a href="{{route('student.info.edit')}}">Επεξεργασία Προσωπικών Στοιχείων</a>
        </div>
    </div>
@endsection
