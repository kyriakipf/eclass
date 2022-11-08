@extends('layouts.teacher')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            {{auth()->user()->name}}
            {{auth()->user()->surname}}
            {{auth()->user()->email}}
            {{auth()->user()->teacher->phone}}
        </div>
    </div>
@endsection
