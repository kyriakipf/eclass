@extends('layouts.admin')
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
            <div class="row">
                <div class="col-md-12">
                    <table>
                        @if(count($subjects) != 0)
                            <thead>
                            <tr class="tableRow colTitles">
                                <th class="subtitle">Τιτλος</th>
                                <th class="subtitle">Περιγραφη</th>
                                <th class="subtitle">Καθηγητής</th>
                                <th class="subtitle">Εξάμηνο</th>
                                <th class="subtitle">Εγγεγραμμενοι Φοιτητές</th>
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
                                                class="paragraph">{{substr($subject->summary, 0,130)}}...</p></a>
                                    </td>
                                    <td class="col-md-2">
                                        <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{$subject->teacher[0]->user->name}} {{$subject->teacher[0]->user->surname}}</p>
                                        </a>
                                    </td>
                                    <td class="col-md-2">
                                        <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{$subject->semester->number}}ο Εξάμηνο</p></a>
                                    </td>
                                    <td class="col-md-3"><a
                                            href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{count($subject->student)}}</p></a>
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
