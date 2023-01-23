@extends('layouts.teacher')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
        </div>
        <div class="bottom-section">
            <p class="title purple">Αλλαγή Κωδικού</p>
            <form action="{{route('change.password.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row addForm changePass">
                    <div class="col-md-6">
                        <div class="input-container focused">
                            <label for="name" class="input-label">Email</label>
                            <input type="text" name="name" id="name"
                                   placeholder="Γράψτε εδώ..." readonly value="{{auth()->user()->email}}"
                                   class="text-input">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-container focused">
                            <label for="oldPassword" class="input-label">Παλιός Κωδικός</label>
                            <input type="password" name="oldPassword" id="oldPassword" class="text-input"
                                   placeholder="Γράψτε εδώ..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-container focused">
                            <label for="newPassword" class="input-label">Καινούργιος Κωδικός</label>
                            <input type="password" name="newPassword" id="newPassword" class="text-input"
                                   placeholder="Γράψτε εδώ..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-container focused">
                            <label for="confirmPassword" class="input-label">Επαλήθευση Κωδικού</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="text-input"
                                   placeholder="Γράψτε εδώ..." required>
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
