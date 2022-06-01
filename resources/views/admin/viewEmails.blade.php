@extends('layouts.admin')
@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset("css/createEmail.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12">
            <div style="background-image: url({{ asset('assets/img/boy.png') }})" class="banner col-md-6">
            </div>
        </div>
        <div class="bottom-section">
            <div class="topRow">
                <p class="title purple">Μηνύματα</p>
            </div>
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
                                        <p class="paragraph">{{$email->subject}}</p>
                                    </td>
                                    <td class="col-md-3">
                                        <p class="paragraph">{{$email->message}}</p>
                                    </td>
                                    <td class="col-md-3">
                                        <p class="paragraph">{{$email->from}}</p>
                                    </td>
                                    <td class="col-md-2">
                                        <p class="paragraph">{{$email->to}}</p>
                                    </td>
                                    <td class="col-md-3">
                                        <p class="paragraph">{{$email->send_date}}</p>
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

