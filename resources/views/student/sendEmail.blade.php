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
        <p class="title purple">Δημιουργία Μηνύματος</p>
        <form action="{{route('student.email.process')}}">
            <div class="form-container row">
                <div class="typeSelection selection col-md-6">
                </div>
                <div class="student selection col-md-6 ">
                    <label for="userSelect" class="input-label">Επιλέξτε χρήστες: </label>
                    <select name="userSelect[]" id="userSelect" class="select text-input "
                            multiple="multiple">
                        @foreach($teachers as $teacher)
                            <option
                                value="{{$teacher->user->email}}">{{$teacher->user->surname}} {{$teacher->user->name}}
                                : {{$teacher->user->email}}</option>
                        @endforeach
                    </select>
                    <input id="selectall" type="checkbox">Select All
                </div>
                <div class="subject col-md-6">
                    <label for="emailSubject" class="input-label">Subject</label>
                    <textarea name="emailSubject" id="emailSubject" cols="30" rows="10"
                              placeholder="Γράψτε εδώ..." class="text-input area-input"></textarea>
                </div>
                <div class="content col-md-6">
                    <label class="input-label" for="emailContent">Content</label>
                    <textarea name="emailContent" class="text-input area-input" placeholder="Γράψτε εδώ..."
                              id="emailContent" cols="30"
                              rows="10" required></textarea>
                </div>
                <div class="btn-container col-md-2">
                    <button type="submit" class="button bold ">Αποστολή</button>
                </div>
            </div>
        </form>
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
                f("#selectall").click(function () {
                    if (f("#selectall").is(':checked')) {
                        f("#userSelect > option").prop("selected", "selected");
                        f("#userSelect").trigger("change");
                    } else {
                        f("#userSelect > option").removeAttr("selected");
                        f("#userSelect").trigger("change");
                    }
                });
            });
        });
    </script>
@endsection
