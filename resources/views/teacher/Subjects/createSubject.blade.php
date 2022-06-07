@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="top-section">
        <div style="background-image: url({{ asset('assets/img/boy.png') }})" class="banner col-md-6">
        </div>
    </div>
    <div class="bottom-section">
        <form action="{{route('subject.store')}}" method="post">
            <div class="form-container row">
                <div class="title col-md-3">
                    <label for="title" class="input-label">Τίτλος Μαθήματος</label>
                    <input name="title" id="title" type="text"
                           placeholder="Γράψτε εδώ..." class="text-input">
                </div>
                <div class="teacher col-md-2">
                    <label for="teacher" class="input-label">Καθηγητής</label>
                    <select name="title" id="teacher" type="s"
                            class="text-input">
                        @foreach($teachers as $teacher)
                            <option @if(auth()->user()->id === $teacher->id) selected
                                    @endif value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->surname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="semester col-md-7">
                    <label for="semester" class="input-label">Εξάμηνο</label>
                    <select name="title" id="semester" type="s"
                            class="text-input">
                        <option value="1">1ο Εξάμηνο</option>
                        <option value="2">2ο Εξάμηνο</option>
                        <option value="3">3ο Εξάμηνο</option>
                        <option value="4">4ο Εξάμηνο</option>
                        <option value="5">5ο Εξάμηνο</option>
                        <option value="6">6ο Εξάμηνο</option>
                        <option value="7">7ο Εξάμηνο</option>
                        <option value="8">8ο Εξάμηνο</option>
                    </select>
                </div>
                <div class="protected col-md-1">
                    <label class="input-label" for="protected">Εγγραφή με κωδικό</label>
                    <input type="checkbox" id="protected">
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
