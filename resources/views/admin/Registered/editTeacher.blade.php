@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
        </div>
        <div class="bottom-section">
            @if($errors->any())
                <p class="alert alert-danger">
                    {{$errors->all()[0]}}
                </p>
            @endif
            <p class="title purple">Επεξεργασία Στοιχείων Καθηγητή</p>
            <form action="{{route('teacher.update', ['user' => $teacher])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row addForm" style="justify-content: center !important;">
                    <div class="col-md-12 row" style="justify-content: center !important;">
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Όνομα</label>
                                <input type="text" name="name" id="name" class="text-input"
                                       value="{{$teacher->name}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="surname" class="input-label">Επίθετο</label>
                                <input type="text" name="surname" id="surname" class="text-input"
                                       value="{{$teacher->surname}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="email" class="input-label">E-mail</label>
                                <input type="text" name="email" id="email" value="{{$teacher->email}}" class="text-input"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row" style="justify-content: center !important;">
                        <div class="col-md-2">
                            <div class="select-container focused">
                                <label class="input-label" for="domain">Τμήμα</label>
                                <input type="text" class="text-input disabled" name="domain" id="domain"
                                       value="{{$teacher->domain->name}}" required readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="select-container focused">
                                <label class="input-label" for="job_role">Ιδιότητα</label>
                                <select class="select-input" name="job_role" id="job_role" required>
                                    <option value="" selected disabled>Επιλέξτε Ιδιότητα</option>
                                    @foreach($job_roles as $job_role)
                                        <option value="{{$job_role->id}}"
                                                @if($job_role->id == $teacher->teacher->job_role->id) selected @endif >{{$job_role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 btn-container">
                        <button type="submit" class="button bold">
                            <span>ΑΠΟΘΗΚΕΥΣΗ</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
