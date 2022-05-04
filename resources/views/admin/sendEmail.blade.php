@extends('layouts.admin')
@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="title">
            <p>Επιλέξτε Παραλήπτες</p>
        </div>
        <div class="form-container">
            <form action="{{route('email.process')}}">
                <div class="typeSelection">
                    <label for="userType">Επιλέξτες κατηγορία χρήστη: </label>
                    <select name="userType" id="userType">
                        <option value="teacher">Καθηγητές</option>
                        <option value="student">Φοιτητές</option>
                        <option value="user">Όλοι</option>
                    </select>
                </div>
                <div class="teacher selection">
                    <select name="teacherSelect[]" id="teacherSelect" class="teacher select" multiple="multiple" >
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher}}">{{$teacher->surname}} {{$teacher->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="student selection">
                    <select name="studentSelect" id="studentSelect" class="student select" multiple="multiple">
                        @foreach($students as $student)
                            <option value="{{$student->id}}">{{$student->surname}} {{$student->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="user selection">
                    <select name="userSelect" id="userSelect" class="user select" multiple="multiple">
                        @foreach($students as $student)
                            <option value="{{$student->id}}">{{$student->surname}} {{$student->name}}</option>
                        @endforeach
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->surname}} {{$teacher->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="subject">
                    <label for="emailSubject">Subject</label>
                    <textarea name="emailSubject" id="emailSubject" cols="30" rows="10"
                              placeholder="type here"></textarea>
                </div>
                <div class="content">
                    <label for="emailContent">Content</label>
                    <textarea name="emailContent" id="emailContent" cols="30" rows="10"></textarea>
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".typeSelection").change(function () {
                $(this).find("option:selected").each(function () {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".select").not("." + optionValue).prop("disabled", true);
                        $("." + optionValue).prop("disabled", false);
                    } else {
                        $(".select").prop("disabled", true);
                    }
                });
            }).change();

            $('.select').each(function () {
                $(this).select2({
                    placeholder: "Επιλέξτε χρήστη..."
                });
            });
        });
    </script>
@endsection
