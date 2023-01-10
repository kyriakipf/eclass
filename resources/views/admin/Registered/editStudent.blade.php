@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12"></div>
        <div class="bottom-section">
            <p class="title purple">Επεξεργασία Στοιχείων Φοιτητή</p>
            <form action="{{route('student.update' , $student)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row addForm" style="justify-content: center !important;">
                    <div class="col-md-12 row" style="justify-content: center !important;">
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Όνομα</label>
                                <input type="text" name="name" id="name" class="text-input"
                                       value="{{$student->name}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="surname" class="input-label">Επίθετο</label>
                                <input type="text" name="surname" id="surname" class="text-input"
                                       value="{{$student->surname}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="email" class="input-label">E-mail</label>
                                <input type="text" name="email" id="email" value="{{$student->email}}"
                                       class="text-input"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row" style="justify-content: center !important;">
                        <div class="col-md-2">
                            <div class="select-container focused">
                                <label class="input-label" for="am">Αριθμός Μητρώου</label>
                                <input type="text" class="text-input" name="am" id="am"
                                       value="{{$student->student->am}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="select-container focused">
                                <label class="input-label" for="domain">Τμήμα</label>
                                <input type="text" class="text-input disabled" name="domain" id="domain"
                                       value="{{$student->domain->name}}" required readonly>
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
