@extends('layouts.teacher')
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
                    <p class="paragraph mt-1">
                        <a href="{{route('homework.create', ['subject' => $subject])}}" class="paragraph">Προσθήκη</a>
                    </p>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('subject.show' , ['subject' => $subject])}}">Επιστροφή</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <form action="{{route('homework.search.form', ['subject' => $subject])}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" id="search" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-auto">
                        <button type="submit" class="light minimalButton"><i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    @if(count($homework) != 0)
                    <table>
                            <thead>
                            <tr class="tableRow colTitles">
                                <th class="sort">Τιτλος</th>
                                <th class="sort">Περιγραφη</th>
                                <th class="sort">Μάθημα</th>
                                <th class="sort">Είδος</th>
                                <th class="sort">Προθεσμία</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($homework as $single)
                                <tr class="tableRow">
                                    <td>
                                        <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p class="paragraph">{{$single->title}}</p></a>
                                    </td>
                                    <td>
                                        <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{substr($single->summary, 0,130)}}...</p></a>
                                    </td>
                                    <td>
                                        <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{$single->subject->title}}</p></a>
                                    </td>
                                    <td>
                                        <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{$single->homework_type}}</p></a>
                                    </td>
                                    <td>
                                        <a href="{{route('homework.show', ['homework' => $single , 'subject' => $single->subject])}}">
                                            <p
                                                class="paragraph">{{\Carbon\Carbon::parse($single->due_date)->format('d-m-Y')}}</p>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('homework.edit', ['homework' => $single, 'subject' => $subject])}}"
                                           class="edit"><i
                                                class="fa-regular fa-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('homework.delete', ['homework' => $single])}}"
                                           class="delete"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                        {{$homework->links()}}
                    @else
                        <div class="tableRow">
                            <a href="{{route('homework.create', ['subject' => $subject])}}" class="paragraph">Δεν
                                υπάρχουν διαθέσιμες εργασίες. Πατήστε εδώ για να
                                δημιουργήσετε μία εργασία.</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
