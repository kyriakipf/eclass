@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            <p class="title purple">Εργασίες</p>
            <div class="topRow">
                <a class="search" href="#"><i class="fa-light fa-magnifying-glass"></i>
                    Αναζήτηση</a>
            </div>
            <div class="row">
                @livewire('homework-list', [ 'homework' => $homework])
            </div>
        </div>
    </div>
@endsection
