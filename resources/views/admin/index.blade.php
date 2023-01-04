@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
            <div class="stats-container col-md-6">
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-envelope"></i> Προσκεκλημένοι:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($invitedTeachers)}}</p>
                            <p>Καθηγητές</p>
                        </div>
                        <div class="counter">
                            <p class="number">{{count($invitedStudents)}}</p>
                            <p>Φοιτητές</p>
                        </div>
                    </div>
                </div>
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-pencil"></i> Εγγεγραμμένοι:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($teachers)}}</p>
                            <p>Καθηγητές</p>
                        </div>
                        <div class="counter">
                            <p class="number">{{count($students)}}</p>
                            <p>Φοιτητές</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-section col-md-12 row">
        <div class="subtitle col-md-6">
            Μαθήματα Εξαμήνου
            <table>
                @if(!is_null($activeSubjects))
                    <thead>
                    <tr class="tableRow colTitles">
                        <th class="sort" wire:click="sortBy('title')">Τιτλος</th>
                        <th class="sort" wire:click="sortBy('summary')">Περιγραφη</th>
                        <th class="sort" wire:click="sortBy('semester_id')">Εξάμηνο</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activeSubjects as $subject)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{$subject->title}}</p></a>
                            </td>
                            <td class="col-md-5">
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{substr($subject->summary, 0,130)}}...</p>
                                </a>
                            </td>
                            <td class="col-md-3">
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{$subject->semester->number}}ο Εξάμηνο</p>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
                    @endif
                    </tbody>
            </table>
        </div>
        <div class="courses-chart col-md-6">
            <p class="subtitle">Φοιτητές ανα Μάθημα</p>
        </div>
    </div>
    </div>
@endsection
