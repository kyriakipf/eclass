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
            <a href="{{route('admin.subject.show', ['subject' => $group->subject])}}">Back</a>
            <p>Title: {{$group->title}}</p>
            <p>Summary: {{$group->summary}}</p>
            <p>Capacity: {{$group->capacity}}</p>
        </div>
    </div>
@endsection
