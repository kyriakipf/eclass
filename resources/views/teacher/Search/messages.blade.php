@extends('layouts.teacher')

@section('title')
    Αναζήτηση Μαθήματος
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <div class="top-section">
        <div class=" main-info flex justify-start align-baseline">
            <div class="col-md-auto">
                <div class="flex">
                    <p class="title" style="margin-bottom: 0 !important;">Μηνύματα</p>
                </div>
            </div>
            <div class="col-md-1 ml-auto">
                <a href="{{route('teacher.email')}}">Επιστροφή</a>
            </div>
        </div>
    </div>
    <div class="bottom-section">
        <form action="{{route('teacher.email.search.form')}}" method="POST">
            @csrf
            <div class="row addForm">
                <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                       placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                <div class="col-auto">
                    <button type="submit" class="minimalButton light"><i class="fa-solid fa-magnifying-glass"></i>
                    </button>
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
                    <th>Μάθημα</th>
                    <th>Ημερομηνία Αποστολής</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($messages as $message)
                    <tr class="tableRow">
                        <td>
                            <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                    class="paragraph">{{$message->subject}}</p></a>
                        </td>
                        <td >
                            <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                    class="paragraph">{{substr($message->message, 0,130)}}...</p></a>
                        </td>
                        <td >
                            <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                    class="paragraph">{{$message->from}}</p></a>
                        </td>
                        <td>
                            <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                    class="paragraph">{{$message->subjects->title}}</p></a>
                        </td>
                        <td >
                            <a href="{{route('teacher.email.show' , ['email' => $message])}}"><p
                                    class="paragraph">{{$message->send_date}}</p></a>
                        </td>
                        <td >
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
@endsection


