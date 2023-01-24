@extends('layouts.teacher')
@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset("css/createEmail.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">Προβολή Μηνύματος</p>
                    </div>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('teacher.email')}}">Επιστροφή</a>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-section">
        <div class="flex justify-start mt-3">
            <div class="col-auto">
                <p class="smallTitle">Θέμα: {{$email->subject}}</p>
                <p class="paragraph mt-2">{{$email->message}}</p>
            </div>
        </div>
    </div>
@endsection
