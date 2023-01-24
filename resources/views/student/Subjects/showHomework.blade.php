@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">Εργασίες</p>
                    </div>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('student.subject.show' , ['subject' => $subject])}}">Επιστροφή</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row">
                <div class="col-md-12">
                    @if(count($homework) != 0)
                        <table>
                            <thead>
                            <tr class="tableRow colTitles">
                                <th class="sort">Τιτλος</th>
                                <th class="sort">Περιγραφη</th>
                                <th class="sort">Μάθημα</th>
                                <th class="sort">Είδος Εργασίας</th>
                                <th class="sort">Προθεσμία</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($homework as $single)
                                <tr class="tableRow">
                                    <td >
                                        <a href="{{route('student.homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p class="paragraph">{{$single->title}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{substr($single->summary, 0,130)}}...</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{$single->subject->title}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{$single->homework_type}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.homework.show', ['homework' => $single , 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{\Carbon\Carbon::parse($single->due_date)->format('d-m-Y')}}</p>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$homework->links()}}
                    @else
                        <div class="tableRow">
                            <p class="paragraph">Δεν
                                υπάρχουν διαθέσιμες εργασίες.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
