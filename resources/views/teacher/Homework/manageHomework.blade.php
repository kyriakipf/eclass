@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
    @livewireStyles
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">Εργασίες</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            @if(!isset($subject))
                {{$subject = null}}
            @endif
            <form action="{{route('homework.search.form', ['subject' => $subject])}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" id="search" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-auto">
                        <button type="submit" class="minimalButton light"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
            <div class="row">
                @livewire('homework-list', [ 'homework' => $homework])
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
