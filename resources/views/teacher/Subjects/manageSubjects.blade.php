@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
    @livewireStyles
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">

        <div class="bottom-section">
            <p class="title purple">Μαθήματα</p>
            <form action="{{route('subject.search.form')}}" method="POST">
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
                @livewire('subject-list', [ 'subjects' => $subjects])
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection
