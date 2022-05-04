@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        {{--                        Kane sundesh gia na ferneis to onoma tou rolou--}}
        <h2>Επεξεργασία Καθηγητή</h2>
        <form action="{{route('teacher.invite.update', $teacher)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row addForm">
                <div class="col-5">
                    <div class="input-container focused">
                        <label for="name" class="label-text">Όνομα</label>
                        <input type="text" name="name" id="name"
                               value="{{$teacher->name}}" required>
                    </div>
                </div>
                <div class="col-5">
                    <div class="input-container focused">
                        <label for="surname" class="label-text">Επίθετο</label>
                        <input type="text" name="surname" id="surname"
                               value="{{$teacher->surname}}" required>
                    </div>
                </div>
                <div class="col-5">
                    <div class="input-container focused">
                        <label for="email" class="label-text">E-mail</label>
                        <input type="text" name="email" id="email" value=" {{$teacher->email}}" required>
                    </div>
                </div>
                <div class="col-5">
                    <div class="select-container focused">
                        <label class="label-text" for="domain">Τμήμα:</label>
                        <select class="my-select" name="domain" id="domain" {{$teacher->domain->id}} required>
                            @foreach($domains as $domain)
                                <option value="{{$domain->id}}" @if($domain->id == $teacher->domain->id) selected @endif >{{$domain->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3 btn-container">
                    <button type="submit" class="save-btn">
                        <span>ΑΠΟΘΗΚΕΥΣΗ</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
