@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p>Welcome.</p>
        <p>{{auth()->user()->name}}</p>
    </div>
@endsection
