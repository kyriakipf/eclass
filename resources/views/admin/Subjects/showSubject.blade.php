@extends('layouts.admin')
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
                    <a href="{{route('admin.subjects')}}">Επιστροφή</a>
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
                <div class="flex mt-5 gap-4">
                    <div class="col-auto">
                        @if($files != null)
                            <a href="{{route('admin.subject.file.show', ['subject' => $subject])}}"
                               class=" button bold">Έγγραφα
                                Μαθήματος</a>
                        @else
                            <p>Δεν υπάρχουν διαθέσιμα έγγραφα</p>
                        @endif
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
