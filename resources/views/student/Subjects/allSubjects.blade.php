@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            <p class="title purple">Μαθήματα</p>
            <a href="{{route('student.subject.register.form')}}">Εγγραφή σε μάθημα</a>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        @if(count($subjects) != 0)
                            <thead>
                            <tr class="tableRow colTitles">
                                <th class="subtitle">Τιτλος</th>
                                <th class="subtitle">Περιγραφη</th>
                                <th class="subtitle">Εξάμηνο</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr class="tableRow">
                                    <td class="col-md-3">
                                        <p class="paragraph">{{$subject->title}}</p>
                                    </td>
                                    <td class="col-md-5">
                                        <p class="paragraph">{{substr($subject->summary, 0,130)}}...</p>
                                    </td>
                                    <td class="col-md-3">
                                        <p class="paragraph">{{$subject->semester->number}}ο Εξάμηνο</p>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
                            @endif
                            </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

