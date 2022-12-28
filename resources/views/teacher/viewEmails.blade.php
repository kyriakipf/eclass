@extends('layouts.teacher')
@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset("css/createEmail.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            <div class="topRow">
                <p class="title purple">Μηνύματα</p>
            </div>
            <form action="{{route('teacher.email.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <label for="search">Αναζήτηση</label>
                    <input class="search text-input col-md-12" id="search" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-md-2">
                        <button type="submit" class="button light">ΑΝΑΖΗΤΗΣΗ</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        @if(count($emails) != 0)
                            <thead>
                            <tr class="tableRow colTitles">
                                <th>Subject</th>
                                <th>Content</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Send Date</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($emails as $email)
                                <tr class="tableRow">
                                    <td class="col-md-3">
                                        <a href="{{route('teacher.email.show', $email)}}"><p class="paragraph">{{$email->subject}}</p></a>
                                    </td>
                                    <td class="col-md-3">
                                        <a href="{{route('teacher.email.show', $email)}}"><p class="paragraph">{{$email->message}}</p></a>
                                    </td>
                                    <td class="col-md-3">
                                        <a href="{{route('teacher.email.show', $email)}}"><p class="paragraph">{{$email->from}}</p></a>
                                    </td>
                                    <td class="col-md-2">
                                        <a href="{{route('teacher.email.show', $email)}}"><p class="paragraph">{{$email->to}}</p></a>
                                    </td>
                                    <td class="col-md-3">
                                        <a href="{{route('teacher.email.show', $email)}}"><p class="paragraph">{{$email->send_date}}</p></a>
                                    </td>
                                    <td>
                                        <a href="{{route('teacher.email.delete', $email)}}" class="delete"><i
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

