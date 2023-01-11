@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
        </div>
        <div class="bottom-section">
            <form action="{{route('subject.file.store',['subject' => $subject, 'folder' => $folder])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="btn-container col-md-2">
                    <button type="submit" class="button bold ">Προσθήκη Αρχείου</button>
                </div>
            </form>
        </div>
    </div>
@endsection
