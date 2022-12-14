@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
            <div class="stats-container col-md-6">
                <div class="stats col-md-5">
                    <div class="title">
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
                    <div class="title">
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
            <div style="background-image: url({{ asset('assets/img/boy.png') }})" class="banner col-md-6">
            </div>
        </div>
    </div>
    <div class="bottom-section col-md-12 row">
        <div class="courses col-md-5">
            <p class="subtitle">Μαθήματα Εξαμήνου</p>
            <table>
                <thead>
                <tr class="tableRow colTitles">
                    <th>ΤΙΤΛΟΣ</th>
                    <th>ΚΑΘΗΓΗΤΗΣ</th>
                    <th>ΕΓΓΕΓΡΑΜΜΕΝΟΙ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
{{--                    @dd($subject->teacher)--}}
                <tr class="table-row">
                    <td class="col-md-3">
                        <p class="paragraph">{{$subject->title}}</p>
                    </td>
                    <td class="col-md-3">
{{--                        <p class="paragraph">{{$subject->teacher->user->name}} {{$subject->teacher->user->surname}}</p>--}}
                    </td>
                    <td class="col-md-3">
                        <p class="paragraph">1023</p>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="courses-chart col-md-6">
            <p class="subtitle">Φοιτητές ανα Μάθημα</p>
        </div>
    </div>
    </div>
@endsection
