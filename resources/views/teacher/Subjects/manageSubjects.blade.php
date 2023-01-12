@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
    @livewireStyles
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12"></div>
    </div>
    <div class="bottom-section">
        <p class="title purple">&nbsp;Μαθήματα&nbsp;&nbsp;</p>
        <form action="{{route('subject.search.form')}}" method="POST">
            @csrf
            <div class="row addForm">
                <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                       placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες..." id="search">
                <div class="col-md-1">
                    <button type="submit" class="light minimalButton"><i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="row">
            @livewire('subject-list', [ 'subjects' => $subjects])
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
