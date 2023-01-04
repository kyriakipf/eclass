@extends('layouts.teacher')
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <div class="mainInfo">
            <p class="header">Αρχική</p>
            <div class="card-container row">
                <div class="card-body col-md-4">
                    <div class="row">
                        <div class="active subjects col-md-7">
                            Τα μαθήματα των τωρινών εξαμήνων
                            <table>
                                @if(!is_null($subjects))
                                    <thead>
                                    <tr class="tableRow colTitles">
                                        <th class="sort" wire:click="sortBy('title')">Τιτλος</th>
                                        <th class="sort" wire:click="sortBy('summary')">Περιγραφη</th>
                                        <th class="sort" wire:click="sortBy('semester_id')">Εξάμηνο</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr class="tableRow">
                                            <td class="col-md-3">
                                                <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                                        class="paragraph">{{$subject->title}}</p></a>
                                            </td>
                                            <td class="col-md-5">
                                                <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                                        class="paragraph">{{substr($subject->summary, 0,130)}}...</p>
                                                </a>
                                            </td>
                                            <td class="col-md-3">
                                                <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                                        class="paragraph">{{$subject->semester->number}}ο Εξάμηνο</p>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('subject.edit' , ['subject' => $subject])}}"
                                                   class="edit"><i
                                                        class="fa-regular fa-pencil"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{route('subject.delete', ['subject' => $subject])}}"
                                                   class="delete"><i
                                                        class="fa-regular fa-trash-can"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
                                    @endif
                                    </tbody>
                            </table>
                        </div>
                        <div class="col-md-5">
                            <p class="title">Calendar</p>
                            <livewire:events-calendar
                                before-calendar-view="vendor/livewire-calendar/before"
                                after-calendar-view="vendor/livewire-calendar/after"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
    @livewireCalendarScripts
@endsection
