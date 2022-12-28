@extends('layouts.teacher')

@section('title')
    Αναζήτηση Μαθήματος
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <section id="content">
        <div class="bottom-section">
            <a href="{{route('teacher.email')}}">Back</a>
            <p class="title purple">Αναζήτηση Μαθήματος</p>
            <form action="{{route('teacher.email.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-md-2">
                        <button type="submit" class="button light">ΑΝΑΖΗΤΗΣΗ</button>
                    </div>
                </div>
            </form>


            @if(count($messages) > 0)
                <table>
                    <thead>
                    <tr class="tableRow colTitles">
                        <th>Θέμα</th>
                        <th>Περιεχόμενο</th>
                        <th>Από</th>
                        <th>Προς</th>
                        <th>Ημερομηνία Αποστολής</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($messages as $message)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                        class="paragraph">{{$message->subject}}</p></a>
                            </td>
                            <td class="col-md-5">
                                <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                        class="paragraph">{{substr($message->message, 0,130)}}...</p></a>
                            </td>
                            <td class="col-md-3">
                                <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                        class="paragraph">{{$message->from}}</p></a>
                            </td>
                            <td class="col-md-3">
                                <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                        class="paragraph">{{$message->to}}</p></a>
                            </td>
                            <td class="col-md-3">
                                <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                        class="paragraph">{{$message->send_date}}</p></a>
                            </td>
                            <td>
                                <a href="{{route('teacher.email.delete', ['email' => $message])}}" class="delete"><i
                                        class="fa-regular fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="comment">Δεν υπάρχουν σχετικά αποτελέσματα...</p>
            @endif
        </div>
    </section>
@endsection


