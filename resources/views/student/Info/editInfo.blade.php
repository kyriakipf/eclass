@extends('layouts.student')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            <form action="{{route('student.info.update')}}" method="post">
                @csrf
                <div class="form-container row">
                    <div class=" col-md-3">
                        <label for="name" class="input-label">Όνομα</label>
                        <input name="name" id="name" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->name}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="surname" class="input-label">Επίθετο</label>
                        <input name="surname" id="surname" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->surname}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="email" class="input-label">email</label>
                        <input name="email" id="email" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->email}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="phone" class="input-label">Κινητό Τηλέφωνο</label>
                        <input name="phone" id="phone" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->student->phone}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="address" class="input-label">Διεύθυνση</label>
                        <input name="address" id="address" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->student->address}}">
                    </div>
                    <div class="btn-container col-md-2">
                        <button type="submit" class="button bold ">Ενημέρωση</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
