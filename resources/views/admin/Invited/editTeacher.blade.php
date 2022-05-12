@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p class="header">Επεξεργασία Καθηγητή</p>
        <hr>
        <form action="{{route('teacher.invite.update', $teacher)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row addForm">
                <div class="col-4">
                    <div class="input-container focused">
                        <label for="name" class="input-label">Όνομα</label>
                        <input type="text" name="name" id="name"
                               value="{{$teacher->name}}" class="text-input" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-container focused">
                        <label for="surname" class="input-label">Επίθετο</label>
                        <input type="text" name="surname" id="surname" class="text-input"
                               value="{{$teacher->surname}}" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-container focused">
                        <label for="email" class="input-label">E-mail</label>
                        <input type="text" name="email" id="email" value="{{$teacher->email}}" class="text-input" required>
                    </div>
                </div>
                <div class="col-5">
                    <div class="select-container focused">
                        <label class="input-label" for="domain">Τμήμα:</label>
                        <select name="domain" id="domain" class="select-input" required>
                            @foreach($domains as $domain)
                                <option value="{{$domain->id}}" @if($domain->id == $teacher->domain->id) selected @endif >{{$domain->name}}</option>
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
