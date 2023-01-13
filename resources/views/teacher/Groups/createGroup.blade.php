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
        <form action="{{route('group.store', ['subject' => $subject])}}" method="post">
            @csrf
            <div class="form-container row" style="justify-content: flex-start">
                <div class="col-md-3">
                    <label for="title" class="input-label">Τίτλος Ομάδας</label>
                    <input name="title" id="title" type="text"
                           placeholder="Γράψτε εδώ..." class="text-input" required>
                </div>
                <div class="col-md-3">
                    <label class="input-label" for="capacity">Αριθμός Φοιτητών</label>
                    <input type="number" name="capacity" id="capacity" min="0" required>
                </div>
                <div class="summary col-md-12">
                    <label class="input-label" for="summary">Περιγραφή</label>
                    <textarea name="summary" class="text-input area-input" placeholder="Γράψτε εδώ..."
                              id="summary" cols="30"
                              rows="10" required></textarea>
                </div>
                <div class="btn-container col-md-2">
                    <button type="submit" class="button bold ">Δημιουργία</button>
                </div>
            </div>
        </form>
    </div>
@endsection
