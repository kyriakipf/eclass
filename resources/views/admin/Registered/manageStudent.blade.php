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
        <div class="topRow">
            <p class="header">Λίστα Μαθητών</p>
            <a class="search" href="{{route('student.search')}}">Αναζήτηση</a>
        </div>
        <div class="row">
            @livewire('student-list', [ 'users' => $users])
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
