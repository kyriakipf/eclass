@extends('layouts.admin')

@section('title')
    Αναζήτηση Καθηγητή
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <section id="content">
        <div class="top-section row col-md-12"></div>
        <div class="bottom-section">
            <div class="row" style="justify-content: space-between; align-items: center">
                <p class="title purple col-md-2">Φοιτητές</p>
                <a href="{{route('students')}}" class="col-md-2">Προβολή όλων</a>
            </div>
            <form action="{{route('student.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-md-1">
                        <button type="submit" class="light minimalButton"><i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>


            @if(count($users) > 0)
                <table>
                    <thead>
                    <tr class="tableRow colTitles">
                        <th>Όνομα</th>
                        <th>Επίθετο</th>
                        <th>Email</th>
                        <th>Αριθμός Μητρώου</th>
                        <th>Τμήμα</th>
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
                            <td class="col-md-2">
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
        </div>
    </section>
@endsection

