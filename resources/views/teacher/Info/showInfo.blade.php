@extends('layouts.teacher')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">Προσωπικές Πληροφορίες</p>
                    </div>
                </div>
            </div>
            <div class="bottom-section">
                <form action="">
                    <div class="row addForm  justify-start">
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Όνομα:</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." readonly
                                       value="{{auth()->user()->name}}"
                                       class="text-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Επίθετο:</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." readonly
                                       value="{{auth()->user()->surname}}"
                                       class="text-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Email:</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." readonly
                                       value="{{auth()->user()->email}}"
                                       class="text-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Τηλέφωνο:</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." readonly
                                       value="{{auth()->user()->teacher->phone}}"
                                       class="text-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Τμήμα:</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." readonly
                                       value="{{auth()->user()->domain->name}}"
                                       class="text-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Ιδιότητα:</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." readonly
                                       value="{{auth()->user()->teacher->job_role->name}}"
                                       class="text-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Διεύθυνση Γραφείου:</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." readonly
                                       value="{{auth()->user()->teacher->office_address}}"
                                       class="text-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('teacher.info.edit')}}" class="button bold col-md-">Επεξεργασία Προσωπικών Στοιχείων</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
