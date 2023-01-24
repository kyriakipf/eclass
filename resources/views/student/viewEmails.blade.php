@extends('layouts.student')
@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset("css/createEmail.css")}}">
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">Μηνύματα</p>
                    </div>
                    <p class="paragraph mt-1">
                        <a href="{{route('student.email.create')}}" class="paragraph">Δημιουργία</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <form action="{{route('student.email.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" id="search" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-auto">
                        <button type="submit" class="minimalButton light"><i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        @if(count($emails) != 0)
                            <thead>
                            <tr class="tableRow colTitles">
                                <th>Θέμα</th>
                                <th>Περιεχόμενο</th>
                                <th>Από</th>
                                <th>Μάθημα</th>
                                <th>Ημερομηνία Αποστολής</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($emails as $email)
                                <tr class="tableRow">
                                    <td>
                                        <a href="{{route('student.email.show', $email)}}"><p
                                                class="paragraph">{{$email->subject}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.email.show', $email)}}"><p
                                                class="paragraph">{{$email->message}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.email.show', $email)}}"><p
                                                class="paragraph">{{$email->from}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.email.show', $email)}}"><p
                                                class="paragraph">@if($email->subjects){{$email->subjects->title}}@else - @endif</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.email.show', $email)}}"><p
                                                class="paragraph">{{$email->send_date}}</p></a>
                                    </td>
                                    <td>
                                        <a href="{{route('student.email.delete', $email)}}" class="delete"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <p class="paragraph">Δεν υπάρχουν μηνύματα.</p>
                            @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @livewireScripts
@endsection

