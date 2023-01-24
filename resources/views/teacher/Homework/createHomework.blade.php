@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="top-section">
    </div>
    <div class="bottom-section">
        <form action="{{route('homework.store', ['subject' => $subject])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-container row">
                <div class=" col-md-3 col-xl-3">
                    <label for="title" class="input-label">Τίτλος Εργασίας</label>
                    <input name="title" id="title" type="text"
                           placeholder="Γράψτε εδώ..." class="text-input">
                </div>
                <div class="subject col-md-3 col-xl-2">
                    <label for="type" class="input-label">Τύπος Εργασίας</label>
                    <select name="homework_type" id="type"
                            class="text-input">
                        <option value="Μαθήματος">Μαθήματος</option>
                        <option value="Εργαστηριακή">Εργαστηριακή</option>
                    </select>
                </div>
                <div class="start-date col-md-3 col-xl-2">
                    <label for="start_date" class="input-label">Ημερομηνία Έναρξης</label>
                    <input type="datetime-local" id="start_date" name="start_date" class="date-input">
                </div>
                <div class="due-date col-md-3 col-xl-2">
                    <label for="due_date" class="input-label">Ημερομηνία Παράδοσης</label>
                    <input type="datetime-local" id="due_date" name="due_date" class="date-input">
                </div>
                <div class="grade col-md-3 col-xl-2">
                    <label for="max_grade" class="input-label">Μέγιστη Βαθμολογία</label>
                    <input type="number" id="max_grade" name="max_grade">
                </div>
                <div class="col-md-3 col-xl-3">
                    <label class="input-label" for="file">Πρόσθήκη Αρχείου</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="summary col-md-12 col-xl-12">
                    <label class="input-label" for="summary">Περιγραφή</label>
                    <textarea name="summary" class="text-input area-input" placeholder="Γράψτε εδώ..."
                              id="summary" cols="30"
                              rows="10" required></textarea>
                </div>
                <div class="btn-container col-md-2 col-xl-2">
                    <button type="submit" class="button bold ">Δημιουργία</button>
                </div>
            </div>
        </form>
    </div>
@endsection
