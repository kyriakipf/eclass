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
            <div class=" main-info">
                <h1>{{$subject->title}}</h1>
                @foreach($users as $user)
                    <h3>{{$user->name}} {{$user->surname}}</h3>
                @endforeach
                <p>{{$subject->semester}}o Εξάμηνο
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
                <h3>Αρχεία</h3>
                <a href="#">Προσθήκη Αρχείου</a>
                {{--                TODO files-> redesign database for files and create crud functionality          --}}
            </div>
            <div class="groups">
                <h3>Ομάδες</h3>
                <a href="#">Προσθήκη Ομάδας</a>
                @if(count($subject->groups) != 0)
                    <div class="group-info">
                        <p>Όνομα</p>
                        <p>Αριθμός Μαθητών</p>
                    </div>
                    @foreach($subject->groups as $group)
                        <div class="group-info">
                            <p>{{$group->title}}</p>
                            {{--                    TODO -> get the number of registered students                   --}}
                            <p>{{$group->capacity}}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="homework">
                <h3>Εργασίες</h3>
                <a href="#">Προσθήκη Εργασίας</a>
                {{--                    TODO homework -> redesign database and create crud functionality                   --}}
            </div>
        </div>
@endsection
