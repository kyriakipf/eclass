@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
    @livewireStyles
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section">
        </div>
        <div class="bottom-section">
            <p class="title purple">Εργασίες</p>
            <form action="{{route('homework.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <label for="search">Αναζήτηση</label>
                    <input class="search text-input col-md-12" id="search" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-md-2">
                        <button type="submit" class="button light">ΑΝΑΖΗΤΗΣΗ</button>
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
