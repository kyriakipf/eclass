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
        <div class="bottom-section">
            <p class="title purple">Εργαστηριακές Ομάδες</p>
            <form action="{{route('group.search.form', ['subject' => $subject])}}" method="POST">
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
                @livewire('group-list', [ 'groups' => $groups])
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
