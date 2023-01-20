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
                        <p class="title" style="margin-bottom: 0 !important;">Δημιουργία Μηνύματος</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-section">
        <form action="{{route('teacher.email.process')}}">
            <div class="form-container row">
                <div class="selection col-md-6">
                    <label for="subjectSelect" class="input-label">Επιλέξτε μάθημα: </label>
                    <select name="subjectSelect" id="subjectSelect" class="select text-input ">
                        @foreach($subjects as $subject)
                            <option
                                value="{{$subject->id}}">{{$subject->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="student selection col-md-6 ">
                    <label for="userSelect" class="input-label">Επιλέξτε χρήστες: </label>
                    <select name="userSelect[]" id="userSelect" class="select text-input "
                            multiple="multiple">
                        @foreach($students as $student)
                            <option
                                value="{{$student->user->email}}">{{$student->user->surname}} {{$student->user->name}}
                                : {{$student->user->email}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <label for="selectall" class="checkbox-label">Επιλογή Όλων</label>
                        <input id="selectall" type="checkbox" >
                    </div>
                </div>
                <div class="subject col-md-6">
                    <label for="emailSubject" class="input-label">ΘΕΜΑ</label>
                    <textarea name="emailSubject" id="emailSubject" cols="30" rows="10"
                              placeholder="Γράψτε εδώ..." class="text-input area-input"></textarea>
                </div>
                <div class="content col-md-6">
                    <label class="input-label" for="emailContent">ΠΕΡΙΕΧΟΜΕΝΟ</label>
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
@endsection
@section('javascripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var f = $.noConflict();
        f(document).ready(function () {
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
