@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p class="header">Επεξεργασία Μαθητή</p>
        <hr>
        <form action="{{route('student.update' , $student)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row addForm">
                <div class="col-md-5">
                    <div class="input-container focused">
                        <label for="name" class="input-label">Όνομα</label>
                        <input type="text" name="name" id="name" class="text-input"
                               value="{{$student->name}}" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-container focused">
                        <label for="surname" class="input-label">Επίθετο</label>
                        <input type="text" name="surname" id="surname" class="text-input"
                               value="{{$student->surname}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-container focused">
                        <label for="email" class="input-label">E-mail</label>
                        <input type="text" name="email" id="email" class="text-input"
                               value="{{$student->email}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-container focused">
                        <label for="am" class="input-label">Μητρώο</label>
                        <input type="text" name="am" id="am" class="text-input"
                               value="{{$student->student->am}}" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="select-container focused">
                        <label class="input-label" for="domain">Τμήμα:</label>
                        <input type="text" value="{{$student->domain->name}}" name="domain" id="domain" class="text-input" required readonly>
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
@endsection
