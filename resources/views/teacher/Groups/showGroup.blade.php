@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <p>Title: {{$group->title}}</p>
        <p>Summary: {{$group->summary}}</p>
        <p>Capacity: {{$group->capacity}}</p>
        <a href="{{route('group.edit',  $group)}}">Edit</a>
        <a href="{{route('group.delete',  $group)}}">Delete</a>
    </div>
@endsection
