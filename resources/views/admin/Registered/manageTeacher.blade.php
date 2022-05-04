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
        <h2>Λίστα Καθηγητών</h2>
        <a href="{{route('teacher.search')}}">Αναζήτηση</a>
        <div class="row">
            @livewire('teacher-list', [ 'teachers' => $teachers])
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
