@extends('layouts.admin')

@section('title')
    Αναζήτηση Καθηγητή
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <section id="content">
        <div class="top-section row col-md-12">
            <div style="background-image: url({{ asset('assets/img/boy.png') }})" class="banner col-md-6">
            </div>
        </div>
        <div class="bottom-section">
            <p class="title purple">Αναζήτηση Καθηγητή</p>
            <form action="{{route('teacher.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-md-2">
                        <button type="submit" class="button light">ΑΝΑΖΗΤΗΣΗ</button>
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
                            <td class="col-md-3">
                                <p class="paragraph">{{$user->domain->name}}</p>
                            </td>
                            <td>
                                <a href="{{route('teacher.show' , $user)}}" class="edit"><i
                                        class="fa-regular fa-pencil"></i></a>
                            </td>
                            <td>
                                <a href="{{route('teacher.delete' , $user)}}" class="delete"><i
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

