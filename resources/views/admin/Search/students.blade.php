@extends('layouts.admin')

@section('title')
    Αναζήτηση Καθηγητή
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <section id="content">
        <p class="header">Αναζήτηση Μαθητή</p>
        <form action="{{route('student.search.form')}}" method="POST">
            @csrf
            <div class="row addForm">
                <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                       placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                <div class="col-md-3">
                    <button type="submit" class="button light">ΑΝΑΖΗΤΗΣΗ</button>
                </div>
            </div>
        </form>


        @if(count($users) > 0)
            <table>
                <thead>
                <tr class="tableRow colTitles">
                    <th class="sort title">Όνομα</th>
                    <th class="sort title">Επίθετο</th>
                    <th class="sort title">Email</th>
                    <th class="am">Αριθμός Μητρώου</th>
                    <th class="title">Τμήμα</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr class="tableRow">
                        <td class="col-md-3">
                            <p class="paragraph">{{$user->name}}</p>
                        </td>
                        <td class="col-md-3">
                            <p class="paragraph">{{$user->surname}}</p>
                        </td>
                        <td class="col-md-3">
                            <p class="paragraph">{{$user->email}}</p>
                        </td>
                        <td class="col-md-3">
                            <p class="paragraph">{{$user->student->am}}</p>
                        </td>
                        <td class="col-md-3">
                            <p class="paragraph">{{$user->domain->name}}</p>
                        </td>
                        <td>
                            <a href="{{route('student.show' , $user)}}" class="edit"><i
                                    class="fa-regular fa-pencil"></i></a>
                        </td>
                        <td>
                            <a href="{{route('student.delete' , $user)}}" class="delete"><i
                                    class="fa-regular fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="comment">Δεν υπάρχουν σχετικά αποτελέσματα...</p>
        @endif
    </section>
@endsection

