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
            <p class="header">Λίστα Καθηγητών</p>
            <a class="search" href="{{route('teacher.search')}}"><i class="fa-light fa-magnifying-glass"></i> Αναζήτηση</a>
        </div>
        <div class="row">
            @livewire('teacher-list', [ 'teachers' => $teachers])
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
