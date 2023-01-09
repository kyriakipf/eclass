@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <div class="row">
            <a href="{{route('subjects')}}">Back</a>
            <div class=" main-info">
                <h1>{{$subject->title}}</h1>
                @foreach($users as $user)
                    <h3>{{$user->name}} {{$user->surname}}</h3>
                @endforeach
                <p>{{$subject->semester->number}}o Εξάμηνο
                    @if($subject->isPublic)
                        - Κωδικός: {{$subject->password}}
                    @endif
                </p>
            </div>
            <div class="summary">
                @if($subject->summary == null)
                    Δεν υπάρχει διαθέσιμη περιγραφή.
                @endif
                {{$subject->summary}}
            </div>
            <div class="files">
                <a href="{{route('subject.file.upload' , ['subject' => $subject])}}">Προσθήκη Αρχείου</a>
                <a href="{{route('subject.directory.create',['subject' => $subject])}}">Δημιουργία Φακέλου</a>
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
                <h3>Φακέλοι</h3>
                @foreach($folders as $folder)
                    <a href="{{route('subject.directory.show', ['subject' => $subject ,'folder' => basename($folder)])}}">{{basename($folder)}}</a>
                @endforeach
            </div>
            <div class="groups">
                <h3>Ομάδες</h3>
                <a href="{{route('group.create')}}">Προσθήκη Ομάδας</a>
                @if(count($subject->groups) != 0)
                    @foreach($subject->groups as $group)
                        <div class="group-info">
                            <a href="{{route('group.show' , $group)}}">{{$group->title}}</a>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="homework">
                <h3>Εργασίες</h3>
                <a href="{{route('homework.create')}}">Προσθήκη Εργασίας</a>
                @if(count($subject->homework) != 0)
                    @foreach($subject->homework as $homework)
                        <div>
                            <a href="{{route('homework.show' , $homework)}}">{{$homework->title}}</a>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="'email">
                <a href="{{route('teacher.email.subject.create', ['subject' => $subject])}}">Αποστολή email</a>
            </div>
        </div>
@endsection
