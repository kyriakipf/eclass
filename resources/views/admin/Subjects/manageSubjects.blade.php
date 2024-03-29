@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
        </div>
        <div class="bottom-section">
            <p class="title purple">Μαθήματα</p>
            <div class="row">
                <div class="col-md-12">
                    @if(count($subjects) != 0)
                        {{$subjects->links()}}
                    <table>
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
                                    <td>
                                        <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{$subject->title}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{substr($subject->summary, 0,130)}}...</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{$subject->teacher[0]->user->name}} {{$subject->teacher[0]->user->surname}}</p>
                                        </a>
                                    </td>
                                    <td >
                                        <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{$subject->semester->number}}<small>ο</small> Εξάμηνο
                                            </p></a>
                                    </td>
                                    <td ><a
                                            href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                                class="paragraph">{{count($subject->student)}}</p></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                    @else
                        <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
