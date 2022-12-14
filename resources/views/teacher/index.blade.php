@extends('layouts.teacher')
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p class="header">Αρχική</p>
        <div class="card-container row">
            <div class="card-body col-md-4">
                <p class="title">Calendar</p>
                <div class="col-md-2">
                    <livewire:events-calendar
                        before-calendar-view="vendor/livewire-calendar/before"
                        after-calendar-view="vendor/livewire-calendar/after"
                    />
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
    @livewireCalendarScripts
@endsection
