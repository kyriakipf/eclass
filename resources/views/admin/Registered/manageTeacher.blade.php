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
        <div class="top-section row col-md-12">
            <div style="background-image: url({{ asset('assets/img/boy.png') }})" class="banner col-md-6">
            </div>
        </div>
        <div class="bottom-section">
            <p class="title purple">Καθηγητές</p>
            <div class="topRow">
                <a class="search" href="{{route('teacher.search')}}"><i class="fa-light fa-magnifying-glass"></i>
                    Αναζήτηση</a>
            </div>
            <div class="row">
                @livewire('teacher-list', [ 'teachers' => $teachers])
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
