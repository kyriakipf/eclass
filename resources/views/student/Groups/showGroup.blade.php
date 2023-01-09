@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <a href="{{route('student.subject.show', ['subject' => $group->subject])}}">Back</a>
        <p>Title: {{$group->title}}</p>
        <p>Summary: {{$group->summary}}</p>
        <p>Capacity: {{count($group->student)}}/{{$group->capacity}}</p>
    </div>
@endsection
