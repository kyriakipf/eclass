@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
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
                        <p class="title" style="margin-bottom: 0 !important;">{{$group->title}} </p>
                        <p class="smallTitle mt-2">&ensp; {{$group->subject->semester->number}}<small>o</small>
                            Εξάμηνο </p>
                        <a href="{{route('group.edit', ['group' => $group, 'subject' => $group->subject])}}"
                           class="ml-5 mt-1"><i
                                class="fa-regular fa-pencil text-lg"></i></a>
                        <a href="{{route('group.delete',  $group)}}" class="ml-3 mt-1"><i
                                class="fa-regular fa-trash-can text-lg"></i></a>
                    </div>
                    <p class="paragraph mt-1">
                        @foreach($users as $user)
                            {{$user->user->name}} {{$user->user->surname}}
                        @endforeach
                        | Αριθμός Φοιτητών: {{$group->capacity}}

                    </p>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('subject.groups.show' , ['subject' => $group->subject])}}">Επιστροφή</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row">
                <div class="flex mt-3">
                    <div class="summary">
                        <p class="subtitle">Περιγραφή</p>
                        @if($group->summary != null)
                            <p class="paragraph collapsable">{{$group->summary}}</p>
                            @if(strlen($group->summary) > 5300)
                                <span class="show-more">Περισσότερα...</span>
                                <span class="show-less">Λιγότερα...</span>
                            @endif
                        @else
                            <p class="paragraph">Δεν υπάρχει διαθέσιμη περιγραφή.</p>
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
