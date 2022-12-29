@extends('layouts.teacher')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            <form action="{{route('teacher.info.update')}}" method="post">
                @csrf
                <div class="form-container row">
                    <div class=" col-md-3">
                        <label for="title" class="input-label">Όνομα</label>
                        <input name="title" id="title" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->name}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="title" class="input-label">Επίθετο</label>
                        <input name="title" id="title" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->surname}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="title" class="input-label">email</label>
                        <input name="title" id="title" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->email}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="title" class="input-label">Ιδιότητα</label>
                        <input name="title" id="title" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->teacher->idiotita}}">
                    </div>
                    <div class=" col-md-3">
                        <label for="title" class="input-label">Διεύθυνση Γραφείου</label>
                        <input name="title" id="title" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input" value="{{auth()->user()->teacher->office_address}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
