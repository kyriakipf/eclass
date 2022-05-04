@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p>Change password.</p>
        <form action="{{route('change.password.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row addForm">
                <div class="col-md-6">
                    <div class="input-container focused">
                        <label for="name" class="label-text">Email</label>
                        <input type="text" name="name" id="name"
                               placeholder="Γράψτε εδώ..." readonly value="{{auth()->user()->email}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-container focused">
                        <label for="oldPassword" class="label-text">Παλιός Κωδικός</label>
                        <input type="password" name="oldPassword" id="oldPassword"
                               placeholder="Γράψτε εδώ..." required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-container focused">
                        <label for="newPassword" class="label-text">Καινούργιος Κωδικός</label>
                        <input type="password" name="newPassword" id="newPassword"
                               placeholder="Γράψτε εδώ..." required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-container focused">
                        <label for="confirmPassword" class="label-text">Επαλήθευση Κωδικού</label>
                        <input type="password" name="confirmPassword" id="confirmPassword"
                               placeholder="Γράψτε εδώ..." required>
                    </div>
                </div>
                <div class="col-md-12 btn-container">
                    <button type="submit" class="save-btn">
                        <span>ΑΠΟΘΗΚΕΥΣΗ</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
