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
        <h2>Επεξεργασία Μαθητή</h2>
        <form action="{{route('student.invite.update' , $student)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row addForm">
                <div class="col-5">
                    <div class="input-container focused">
                        <label for="name" class="label-text">Όνομα</label>
                        <input type="text" name="name" id="name"
                               value="{{$student->name}}" required>
                    </div>
                </div>
                <div class="col-5">
                    <div class="input-container focused">
                        <label for="surname" class="label-text">Επίθετο</label>
                        <input type="text" name="surname" id="surname"
                               value="{{$student->surname}}" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-container focused">
                        <label for="email" class="label-text">E-mail</label>
                        <input type="text" name="email" id="email"
                               value="{{$student->email}}" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-container focused">
                        <label for="email" class="label-text">Αριθμός Μητρώου</label>
                        <input type="text" name="am" id="am"
                               value="{{$student->am}}" required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="select-container focused">
                        <label class="label-text" for="unit_id">Τμήμα:</label>
                        <select class="my-select" name="domain" id="domain" required>
                            @foreach($domains as $domain)
                                <option @if($domain->id == $student->domain->id) selected
                                        @endif value="{{$domain->id}}">{{$domain->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 btn-container">
                    <button type="submit" class="save-btn">
                        <span>ΑΠΟΘΗΚΕΥΣΗ</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
