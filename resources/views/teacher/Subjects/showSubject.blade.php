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
                    </div>
                    <p class="paragraph mt-1">
                        @foreach($users as $user)
                            {{$user->user->name}} {{$user->user->surname}}
                        @endforeach
                        @if($subject->isPublic)
                            | Κωδικός Μαθήματος: {{$subject->password}}
                        @endif
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
                            <span class="show-more">Περισσότερα...</span>
                            <span class="show-less">Λιγότερα...</span>
                        @else
                            <p class="paragraph">Δεν υπάρχει διαθέσιμη περιγραφή.</p>
                        @endif
                    </div>
                </div>
                <div class="mt-5">
                    @if($files != null)
                        <a href="{{route('subject.file.show', ['subject' => $subject])}}"
                           class=" button bold">Έγγραφα
                            Μαθήματος</a>
                    @else
                        <p>Δεν υπάρχουν διαθέσιμα έγγραφα</p>
                    @endif
                </div>
            </div>
        </div>
        {{--                <div class="groups">--}}
        {{--                    <h3>Ομάδες</h3>--}}
        {{--                    <a href="{{route('group.create')}}">Προσθήκη Ομάδας</a>--}}
        {{--                    @if(count($subject->groups) != 0)--}}
        {{--                        @foreach($subject->groups as $group)--}}
        {{--                            <div class="group-info">--}}
        {{--                                <a href="{{route('group.show' , $group)}}">{{$group->title}}</a>--}}
        {{--                            </div>--}}
        {{--                        @endforeach--}}
        {{--                    @endif--}}
        {{--                </div>--}}
        {{--                <div class="homework">--}}
        {{--                    <h3>Εργασίες</h3>--}}
        {{--                    <a href="{{route('homework.create')}}">Προσθήκη Εργασίας</a>--}}
        {{--                    @if(count($subject->homework) != 0)--}}
        {{--                        @foreach($subject->homework as $homework)--}}
        {{--                            <div>--}}
        {{--                                <a href="{{route('homework.show' , $homework)}}">{{$homework->title}}</a>--}}
        {{--                            </div>--}}
        {{--                        @endforeach--}}
        {{--                    @endif--}}
        {{--                </div>--}}
        {{--                <div class="'email">--}}
        {{--                    <a href="{{route('teacher.email.subject.create', ['subject' => $subject])}}">Αποστολή email</a>--}}
        {{--                </div>--}}
    </div>
    </div>
    </div>
@endsection
@section('javascripts')
    <script>
        const s = $.noConflict();
        s(document).ready(function () {
            s('.collapsable').css({"maxHeight": "100px"})
            s('.show-less').hide()
            s('.show-more').on('click', function () {
                s('.collapsable').css({"maxHeight": "unset"})
                s('.show-more').hide()
                s('.show-less').show()
            })
            s('.show-less').on('click', function () {
                s('.collapsable').css({"maxHeight": "100px"})
                s('.show-more').show()
                s('.show-less').hide()
            })
        });
    </script>
@endsection
