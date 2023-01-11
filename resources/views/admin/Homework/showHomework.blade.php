@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
        </div>
        <div class="bottom-section">
            <a href="{{route('admin.subject.show', ['subject' => $homework->subject])}}">Back</a>
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
                    <a href="{{route('homework.file.download', [ 'homework' => $homework])}}">{{basename($homework->filepath)}}</a>
                </div>
            @endif
        </div>
    </div>
@endsection
