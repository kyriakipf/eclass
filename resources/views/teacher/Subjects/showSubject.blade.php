@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">{{$subject->title}} </p>
                        <p class="smallTitle mt-2">&ensp; {{$subject->semester->number}}<small>o</small> Εξάμηνο</p>
                        <a href="{{route('subject.edit', ['subject' => $subject])}}" class="ml-5 mt-1"><i
                                class="fa-regular fa-pencil text-lg"></i></a>
                        <a href="{{route('subject.delete',  ['subject' => $subject])}}" class="ml-3 mt-1"><i
                                class="fa-regular fa-trash-can text-lg"></i></a>
                    </div>
                    <p class="paragraph mt-1">
                        @foreach($users as $user)
                            {{$user->user->name}} {{$user->user->surname}}
                        @endforeach
                        @if($subject->isPublic)
                            | Κωδικός Μαθήματος: {{$subject->password}}
                        @endif
                        | ECTS: {{$subject->ects}} | {{$subject->type}}
                    </p>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('subjects')}}">Επιστροφή</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row">
                <div class="flex mt-3">
                    <div class="summary">
                        <p class="subtitle">Περιγραφή</p>
                        @if($subject->summary != null)
                            <p class="paragraph collapsable">{{$subject->summary}}</p>
                            @if(strlen($subject->summary) > 5300)
                                <span class="show-more">Περισσότερα...</span>
                                <span class="show-less">Λιγότερα...</span>
                            @endif
                        @else
                            <p class="paragraph">Δεν υπάρχει διαθέσιμη περιγραφή.</p>
                        @endif
                    </div>
                </div>
                <div class="flex mt-5 gap-4">
                    <div class="col-auto">
                        <a href="{{route('subject.file.show', ['subject' => $subject])}}"
                           class=" button bold">Έγγραφα
                            Μαθήματος</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{route('subject.homework.show', ['subject' => $subject])}}"
                           class=" button bold">Εργασίες
                            Μαθήματος</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{route('subject.groups.show', ['subject' => $subject])}}"
                           class=" button bold">Ομάδες
                            Μαθήματος</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{route('subject.email.show', ['subject' => $subject])}}"
                           class=" button bold">Μηνύματα
                            Μαθήματος</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{route('subject.students.show', ['subject' => $subject])}}"
                           class=" button bold">Φοιτητές
                            Μαθήματος</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
        const s = $.noConflict();
        s(document).ready(function () {
            s('.collapsable').css({"maxHeight": "500px"})
            s('.show-less').hide()
            s('.show-more').on('click', function () {
                s('.collapsable').css({"maxHeight": "unset"})
                s('.show-more').hide()
                s('.show-less').show()
            })
            s('.show-less').on('click', function () {
                s('.collapsable').css({"maxHeight": "500px"})
                s('.show-more').show()
                s('.show-less').hide()
            })
        });
    </script>
@endsection
