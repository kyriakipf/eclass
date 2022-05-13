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
        <form action="{{route('student.invite.update' , $student)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row addForm">
                <div class="col-5">
                    <div class="input-container focused">
                        <label for="name" class="input-label">Όνομα</label>
                        <input type="text" name="name" id="name" class="text-input"
                               value="{{$student->name}}" required>
                    </div>
                </div>
                <div class="col-5">
                    <div class="input-container focused">
                        <label for="surname" class="input-label">Επίθετο</label>
                        <input type="text" name="surname" id="surname" class="text-input"
                               value="{{$student->surname}}" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-container focused">
                        <label for="email" class="input-label">E-mail</label>
                        <input type="text" name="email" id="email" class="text-input"
                               value="{{$student->email}}" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-container focused">
                        <label for="email" class="input-label">Μητρώο</label>
                        <input type="text" name="am" id="am" class="text-input"
                               value="{{$student->am}}" required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="select-container focused">
                        <label class="input-label" for="unit_id">Τμήμα:</label>
                        <select class="select-input" name="domain" id="domain" required>
                            @foreach($domains as $domain)
                                <option @if($domain->id == $student->domain->id) selected
                                        @endif value="{{$domain->id}}">{{$domain->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2 btn-container">
                    <button type="submit" class="button bold">
                        <span>ΑΠΟΘΗΚΕΥΣΗ</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
