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
                <p class="smallTitle">{{$email->subject}}</p>
                <p class="paragraph mt-2">{{$email->message}}</p>
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
