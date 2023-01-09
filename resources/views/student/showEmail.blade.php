@extends('layouts.student')
@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset("css/createEmail.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
    </div>
    <div class="bottom-section">
        <p class="title purple">{{$email->subject}}</p>
        <div class="form-container row">
            <div class="typeSelection selection col-md-6">
            </div>
            <div class="student selection col-md-6 ">

            </div>
            <div class="subject col-md-6">
                <label for="emailSubject" class="input-label">{{$email->from}}</label>
                <p class="text-input area-input"></p>
            </div>
            <div class="subject col-md-6">
                <label for="emailSubject" class="input-label">{{$email->to}}</label>
                <p class="text-input area-input"></p>
            </div>
            <div class="content col-md-6">
                <label class="input-label" for="emailContent">{{$email->message}}</label>
                <p class="text-input area-input"></p>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('javascripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var f = $.noConflict();
        f(document).ready(function () {
            f(".typeSelection").change(function () {
                f(this).find("option:selected").each(function () {
                    var optionValue = f(this).attr("value");
                    if (optionValue) {
                        f(".select").not("." + optionValue).parent().addClass("disabled");
                        f("." + optionValue).parent().removeClass("disabled");
                    } else {
                        $(".select").addClass("disabled");
                    }
                });
            }).trigger('change');

            f('select').each(function () {
                f(this).select2({
                    closeOnSelect: false,
                    scrollAfterSelect: true
                });
            });
        });
    </script>
@endsection
