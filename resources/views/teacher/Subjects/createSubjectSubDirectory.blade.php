@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="top-section">
    </div>
    <div class="bottom-section">
        <form action="{{route('subject.subdirectory.store',['subject' => $subject, 'folder' => $folder])}}" method="post">
            @csrf
            <div class=" col-md-3">
                <label for="title" class="input-label">Όνομα Φακέλου</label>
                <input name="title" id="title" type="text"
                       placeholder="Γράψτε εδώ..." class="text-input">
            </div>

            <div class="btn-container col-md-2">
                <button type="submit" class="button bold ">Δημιουργία Φακέλου</button>
            </div>
        </form>
    </div>
@endsection
