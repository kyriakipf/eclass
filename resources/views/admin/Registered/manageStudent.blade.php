@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
    @livewireStyles
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <h2>Λίστα Μαθητών</h2>
        <a href="{{route('student.search')}}">Αναζήτηση</a>
        <div class="row">
            @livewire('student-list', [ 'users' => $users])
        </div>

    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
