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
            <p class="paragraph">Όνομα: {{auth()->user()->name}} {{auth()->user()->surname}}</p>
            <p class="paragraph">Email: {{auth()->user()->email}}</p>
            <p class="paragraph">Τηλέφωνο: {{auth()->user()->teacher->phone}}</p>
            <p class="paragraph">Τμήμα: {{auth()->user()->domain->name}}</p>
            <p class="paragraph">Ιδιότητα: {{auth()->user()->teacher->job_role->name}}</p>
            <p class="paragraph mb-2">Διεύθυνση Γραφείου: {{auth()->user()->teacher->office_address}}</p>
            <a href="{{route('teacher.info.edit')}}">Επεξεργασία Προσωπικών Στοιχείων</a>
        </div>
    </div>
@endsection
