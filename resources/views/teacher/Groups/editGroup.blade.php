@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="top-section row col-md-12"></div>
    <div class="bottom-section">
        <form action="{{route('group.update', ['group' => $group, 'subject' => $group->subject])}}" method="post">
            @csrf
            <div class="form-container row" style="justify-content: flex-start">
                <div class="col-md-3">
                    <label for="title" class="input-label">Τίτλος Ομάδας</label>
                    <input name="title" id="title" type="text"
                           placeholder="Γράψτε εδώ..." class="text-input" value="{{$group->title}}">
                </div>
                <div class="col-md-3">
                    <label for="capacity" class="input-label">Αριθμός Μαθητών</label>
                    <input type="number" name="capacity" id="capacity" min="0" class="text-input" value="{{$group->capacity}}">
                </div>
                <div class="col-md-3">
                    <label for="time" class="input-label">Ώρα</label>
                    <input type="text" name="time" id="time" min="0" class="text-input" value="{{$group->time}}">
                </div>
                <div class="summary col-md-12">
                    <label class="input-label" for="summary">Περιγραφή</label>
                    <textarea name="summary" class="text-input area-input" placeholder="Γράψτε εδώ..."
                              id="summary" cols="30"
                              rows="10" required>{{$group->summary}}</textarea>
                </div>
                <div class="btn-container col-md-2">
                    <button type="submit" class="button bold ">Ενημέρωση</button>
                </div>
            </div>
        </form>
    </div>
@endsection
