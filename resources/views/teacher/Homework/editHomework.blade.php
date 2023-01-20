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
        <form action="{{route('homework.update',  ['homework' => $homework, 'subject' => $subject])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-container row">
                <div class="col-md-3">
                    <label for="title" class="input-label">Τίτλος Εργασίας</label>
                    <input name="title" id="title" type="text"
                           placeholder="" class="text-input" value="{{$homework->title}}">
                </div>
                <div class="subject col-md-2">
                    <label for="type" class="input-label">Τύπος Εργασίας</label>
                    <select name="homework_type" id="type" type="" class="text-input">
                        <option value="Μαθήματος" @if($homework->homework_type == 'Μαθήματος') selected @endif>Μαθήματος
                        </option>
                        <option value="Εργαστηριακή" @if($homework->homework_type == 'Εργαστηριακή') selected @endif>
                            Εργαστηριακή
                        </option>
                    </select>
                </div>
                <div class="dates col-md-4 row">
                    <div class="start-date col-md-6">
                        <label for="start_date" class="input-label">Ημερομηνία Έναρξης</label>
                        <input type="datetime-local" id="start_date" name="start_date" class="date-input"
                               value="{{\Carbon\Carbon::parse($homework->start_date)->format('Y-m-d h:m')}}">
                    </div>
                    <div class="due-date col-md-6">
                        <label for="due_date" class="input-label">Ημερομηνία Παράδοσης</label>
                        <input type="datetime-local" id="due_date" name="due_date" class="date-input"
                               value="{{\Carbon\Carbon::parse($homework->due_date)->format('Y-m-d h:m')}}">
                    </div>
                </div>
                <div class="grade col-md-2">
                    <label for="max_grade" class="input-label">Μέγιστη Βαθμολογία</label>
                    <input type="number" id="max_grade" name="max_grade" value="{{$homework->max_grade}}">
                </div>
                @if(is_null($homework->filepath))
                    <div class="col-md-3">
                        <label class="input-label" for="file">Πρόσθήκη Αρχείου</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                @else
                    <div class="col-md-3 flex gap-4">
                        <div class="col-auto">
                            <p class="input-label">Υπάρχον Αρχείο</p>
                            <a href="{{$homework->filepath}}" download>{{basename($homework->filepath)}}</a>
                            <a href="{{route('homework.file.delete' , ['homework' => $homework])}}"><i class="fa-regular fa-trash-can text-lg ml-1"></i></a>
                        </div>
                        <div class="col-auto">
                            <label class="input-label" for="file">Αλλαγή Αρχείου</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                    </div>
                @endif
                <div class="summary col-md-12">
                    <label class="input-label" for="summary">Περιγραφή</label>
                    <textarea name="summary" class="text-input area-input"
                              id="summary" cols="30"
                              rows="10" required>{{$homework->summary}}</textarea>
                </div>
                <div class="btn-container col-md-2">
                    <button type="submit" class="button bold ">Ενημέρωση</button>
                </div>
            </div>
        </form>
    </div>
@endsection
