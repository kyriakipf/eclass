@extends('layouts.student')
@section('header')
    student
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section">
        </div>
        <div class="bottom-section">
            <p class="title">Ημερολόγιο</p>
            <div>
                <livewire:events-calendar
                    before-calendar-view="vendor/livewire-calendar/before"
                    after-calendar-view="vendor/livewire-calendar/after"
                />
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
    @livewireCalendarScripts
@endsection
