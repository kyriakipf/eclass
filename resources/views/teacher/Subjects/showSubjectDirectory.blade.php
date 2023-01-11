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
            <div class="row">
                <a href="{{route('subject.show' , ['subject' => $subject])}}">Back</a>
                <div class=" main-info">
                    <h1>Μάθημα: {{$subject->title}}</h1>
                    <h3>Φάκελος: {{ucfirst($folder)}}</h3>
                    <a href="{{route('subject.subdirectory.create', ['subject' => $subject, 'folder' => $folder])}}">Προσθήκη
                        υποφακέλου</a>
                    @if($subfolders != null)
                        <p>Υποφακέλοι</p>
                        @foreach($subfolders as $subfolder)
                            <a href="{{route('subject.directory.show', ['subject' => $subject ,'folder' => basename($subfolder)])}}">{{basename($subfolder)}}</a>
                        @endforeach
                    @endif
                    <a href="{{route('subject.file.upload', ['subject' => $subject, 'folder' => $folder])}}">Προσθήκη
                        αρχείων</a>
                    @if($files != null)
                        <p>Αρχεία</p>
                        @foreach($files as $file)
                            <div>
                                <a href="{{route('subject.file.download', ['file' => basename($file), 'subject' => $subject])}}">{{basename($file)}}</a>
                            </div>
                        @endforeach
                    @else
                        <p>Δεν υπάρχουν διαθέσιμα αρχεία</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
