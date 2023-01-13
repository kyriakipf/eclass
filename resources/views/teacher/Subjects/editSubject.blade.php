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
        <div class="form-container">
            <form action="{{route('subject.update' , ['subject'=>$subject])}}" method="post">
                @csrf
                <div class="form-container row">
                    <div class=" col-md-3">
                        <label for="title" class="input-label">Τίτλος Μαθήματος</label>
                        <input name="title" id="title" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{$subject->title}}">
                    </div>
                    <div class="teacher col-md-2">
                        <label for="teacher" class="input-label">Καθηγητής</label>
                        <select name="teacherId" id="teacher" type="s"
                                class="text-input">

                            @foreach($users as $user)
                                <option @if($teacherIds === $user->teacher->id) selected
                                        @endif value="{{$user->teacher->id}}">{{$user->name}} {{$user->surname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="semester col-md-7">
                        <label for="semester" class="input-label">Εξάμηνο</label>
                        <select name="semester" id="semester" type="s"
                                class="text-input">
                            @foreach($semesters as $semester)
                                <option @if($subject->semester_id == $semester->id) selected @endif value="{{$semester->id}}">{{$semester->number}}ο Εξάμηνο</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="protected col-md-1">
                        <label class="input-label" for="protected">Εγγραφή με κωδικό</label>
                        <input type="checkbox" id="protected" name="public" @if($subject->isPublic) checked @endif>
                    </div>
                    <div class="password col-md-2">
                        <label class="input-label" for="password">Κωδικός</label>
                        <input name="password" class="text-input" placeholder="Γράψτε εδώ..."
                               id="password" type="text" value="{{$subject->password}}"
                               @if(!$subject->isPublic) disabled
                               @endif required>
                    </div>
                    <div class="description col-md-12">
                        <label class="input-label" for="description">Περιγραφή</label>
                        <textarea name="description" class="text-input area-input" placeholder="Γράψτε εδώ..."
                                  id="description" cols="30"
                                  rows="10" required>{{$subject->summary}}</textarea>
                    </div>
                    <div class="btn-container col-md-2">
                        <button type="submit" class="button bold ">Ενημέρωση</button>
                    </div>
                </div>
            </form>
        </div>
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
