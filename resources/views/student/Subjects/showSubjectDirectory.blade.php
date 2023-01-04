@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <div class="row">
            <a href="{{route('student.subject.show' , ['subject' => $subject])}}">Back</a>
            <div class=" main-info">
                <h1>Μάθημα: {{$subject->title}}</h1>
                <h3>Φάκελος: {{ucfirst($folder)}}</h3>
                @if($subfolders != null)
                    <p>Υποφακέλοι</p>
                    @foreach($subfolders as $subfolder)
                        <a href="{{route('student.subject.directory.show', ['subject' => $subject ,'folder' => basename($subfolder)])}}">{{basename($subfolder)}}</a>
                    @endforeach
                @endif
                @if($files != null)
                    <p>Αρχεία</p>
                    @foreach($files as $file)
                        <div>
                            <a href="{{route('student.subject.file.download', ['file' => basename($file), 'subject' => $subject])}}" >{{basename($file)}}</a>
                        </div>
                    @endforeach
                @else
                    <p>Δεν υπάρχουν διαθέσιμα αρχεία</p>
                @endif
            </div>
        </div>
    </div>
@endsection
