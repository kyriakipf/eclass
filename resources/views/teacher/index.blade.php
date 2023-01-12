@extends('layouts.teacher')
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
        </div>
        <div class="bottom-section row">
            <div class="col-md-7">
                <p class="title">Μαθήματα Τρέχοντος Εξαμήνου</p>
                <table>
                    @if(count($subjects) > 0)
                        <thead>
                        <tr class="tableRow">
                            <th class="colTitles">Τιτλος</th>
                            <th class="colTitles">Περιγραφη</th>
                            <th class="colTitles">Καθηγητής</th>
                            <th class="colTitles">Εξάμηνο</th>
                            <th class="colTitles">Εγγραμμένοι</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr class="tableRow">
                                <td class="col-md-2">
                                    <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{$subject->title}}</p></a>
                                </td>
                                <td class="col-md-2">
                                    <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{substr($subject->summary, 0,130)}}...</p>
                                    </a>
                                </td>
                                <td class="col-md-2">
                                    <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{$subject->teacher[0]->user->name}} {{$subject->teacher[0]->user->surname}}</p>
                                    </a>
                                </td>
                                <td class="col-md-2">
                                    <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{$subject->semester->number}}ο Εξάμηνο</p>
                                    </a>
                                </td>
                                <td class="col-md-2">
                                    <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{count($subject->student)}}</p>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα...</p>
                        </tbody>
                    @endif
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
@endsection
@section('javascripts')
    @livewireScripts
    @livewireCalendarScripts
@endsection
