@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12" style="border-bottom: 2px solid #F9627D;">
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
            <div class="stats-container col-md-5">
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-books"></i> Χειμερινό:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($winterSubjects)}}</p>
                            <p>Μαθήματα</p>
                        </div>
                    </div>
                </div>
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-books"></i> Εαρινό:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($summerSubjects)}}</p>
                            <p>Μαθήματα</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-section col-md-12 row">
        <div class="col-md-6">
            <p class="title">Μαθήματα Τρέχοντος Εξαμήνου</p>
            <table>
                @if(count($activeSubjects) > 0)
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
                    @foreach($activeSubjects as $subject)
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
                        <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
                    @endif
                    </tbody>
            </table>
        </div>
        <div class="courses-chart col-md-6">
            <p class="title">Φοιτητές ανα Μάθημα</p>
        </div>
    </div>
    </div>
@endsection
