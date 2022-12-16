@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <a href="{{route('subject.show', ['subject' => $homework->subject])}}">Back</a>
        <p>Title: {{$homework->title}}</p>
        <p>Summary: {{$homework->summary}}</p>
        <p>User: {{$homework->user->name}} {{$homework->user->surname}}</p>
        <p>Max Grade: {{$homework->max_grade}}</p>
        <p>Type: {{$homework->homework_type}}</p>
        @if(is_null($homework->filepath))
            <p>Δεν υπαρχουν αρχεία</p>
        @else
            <div class="col-md-3">
                <p>Αρχείο</p>
                <a href="{{$homework->filepath}}" download>{{basename($homework->filepath)}}</a>
            </div>
        @endif
        <a href="{{route('homework.edit',  $homework)}}">Edit</a>
        <a href="{{route('homework.delete',  $homework)}}">Delete</a>
    </div>
@endsection
