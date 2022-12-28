@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <form action="{{route('group.store')}}" method="post">
            @csrf
            <div class="form-container row">
                <div class="col-md-3">
                    <label for="title" class="input-label">Τίτλος Ομάδας</label>
                    <input name="title" id="title" type="text"
                           placeholder="Γράψτε εδώ..." class="text-input">
                </div>
                <div class="subject col-md-2">
                    <label for="subject" class="input-label">ΜάΘημα</label>
                    <select name="subjectId" id="subject" type=""
                            class="text-input">
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="summary col-md-12">
                    <label class="input-label" for="summary">Περιγραφή</label>
                    <textarea name="summary" class="text-input area-input" placeholder="Γράψτε εδώ..."
                              id="summary" cols="30"
                              rows="10" required></textarea>
                </div>
                <div class="capacity">
                    <label for="capacity">Αριθμός Μαθητών</label>
                    <input type="number" name="capacity" min="0">
                </div>
                <div class="btn-container col-md-2">
                    <button type="submit" class="button bold ">Δημιουργία</button>
                </div>
            </div>
        </form>
    </div>
@endsection
