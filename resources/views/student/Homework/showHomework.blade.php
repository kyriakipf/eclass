@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <a href="{{route('student.subject.show', ['subject' => $homework->subject])}}">Back</a>
        <p>Title: {{$homework->title}}</p>
        <p>Summary: {{$homework->summary}}</p>
        <p>Teacher: {{$homework->user->name}} {{$homework->user->surname}}</p>
        <p>Max Grade: {{$homework->max_grade}}</p>
        <p>Type: {{$homework->homework_type}}</p>
        @if(is_null($homework->filepath))
            <p>Δεν υπαρχουν αρχεία</p>
        @else
            <div class="col-md-3">
                <p>Αρχείο</p>
                <a href="{{route('student.homework.file.download', [ 'homework' => $homework])}}" >{{basename($homework->filepath)}}</a>
            </div>
        @endif
        <p>Εαν έχετε ήδη ανεβάσει αρχείο και ανεβάσετε πάλι, το προηγούμενο αρχείο θα διαγραφεί.</p>
        <form action="{{route('student.homework.file.store',['homework' => $homework])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <input type="file" name="file" class="form-control" required>
            </div>
            <div class="btn-container col-md-2">
                <button type="submit" class="button bold ">Προσθήκη Αρχείου</button>
            </div>
        </form>

        <div class="col-md-3">
            <p>Αρχείο</p>
            <a href="{{route('student.homework.selffile.download', [ 'homework' => $homework])}}" >{{$filepath}}</a>
        </div>
    </div>
@endsection
