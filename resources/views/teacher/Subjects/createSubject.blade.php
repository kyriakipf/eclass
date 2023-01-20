@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="top-section">
    </div>
    <div class="bottom-section">
        <form action="{{route('subject.store')}}" method="post">
            @csrf
            <div class="form-container row">
                <div class=" col-md-3">
                    <label for="title" class="input-label">Τίτλος Μαθήματος</label>
                    <input name="title" id="title" type="text"
                           placeholder="Γράψτε εδώ..." class="text-input">
                </div>
                <div class="semester col-md-1" >
                    <label for="semester" class="input-label">Εξάμηνο</label>
                    <select name="semester" id="semester" type="s"
                            class="text-input">
                        @foreach($semesters as $semester)

                            <option value="{{$semester->id}}">{{$semester->number}}ο Εξάμηνο</option>
                        @endforeach
                    </select>
                </div>
                <div class=" col-md-1">
                    <label for="ects" class="input-label">ECTS</label>
                    <input name="ects" id="ects" type="text"
                           placeholder="Γράψτε εδώ..." class="text-input">
                </div>
                <div class="semester col-md-1" >
                    <label for="type" class="input-label">Είδος Μαθήματος</label>
                    <select name="type" id="type" type="s"
                            class="text-input">
                            <option value="Κορμού">Κορμού</option>
                            <option value="Επιλογής">Επιλογής</option>

                    </select>
                </div>
                <div class="protected col-md-1">
                    <label class="input-label" for="protected">Εγγραφή με κωδικό</label>
                    <input type="checkbox" id="protected" name="public">
                </div>
                <div class="password col-md-2">
                    <label class="input-label" for="password">Κωδικός</label>
                    <input name="password" class="text-input" placeholder="Γράψτε εδώ..."
                           id="password" type="text" disabled required>
                </div>
                <div class="description col-md-12">
                    <label class="input-label" for="description">Περιγραφή</label>
                    <textarea name="description" class="text-input area-input" placeholder="Γράψτε εδώ..."
                              id="description" cols="30"
                              rows="10" required></textarea>
                </div>
                <div class="btn-container col-md-2">
                        <button type="submit" class="button bold ">Δημιουργία</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('javascripts')
    <script>
        f = $.noConflict();
        f(document).ready(function () {
            f("#protected").change(function () {
                if (f(this).is(':checked')) {
                    f("#password").removeAttr('disabled');
                } else {
                    f("#password").prop('disabled', true);
                }
            });
        });
    </script>
@endsection
