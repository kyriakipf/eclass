@extends('layouts.teacher')
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
        </div>
        <div class="bottom-section row">
            <div class="col-xl-6">
                <p class="title">Μαθήματα Τρέχοντος Εξαμήνου</p>
                @if(count($subjects) > 0)
                    {{$subjects->links()}}
                    <table>
                        <thead>
                        <tr class="tableRow">
                            <th class="colTitles">Τιτλος</th>
                            <th class="colTitles">Περιγραφη</th>
                            <th class="colTitles">Καθηγητής</th>
                            <th class="colTitles">Εξάμηνο</th>
                            <th class="colTitles">Φοιτητές</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr class="tableRow">
                                <td>
                                    <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{$subject->title}}</p></a>
                                </td>
                                <td>
                                    <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{substr($subject->summary, 0,100)}}...</p>
                                    </a>
                                </td>
                                <td >
                                    <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{$subject->teacher[0]->user->name}} {{$subject->teacher[0]->user->surname}}</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{$subject->semester->number}}<small>ο</small> Εξάμηνο</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                            class="paragraph">{{count($subject->student)}}</p>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα...</p>
                    </tbody>
                @endif
            </div>
            <div class="col-xl-6">
                <p class="title">Ημερολόγιο</p>
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
