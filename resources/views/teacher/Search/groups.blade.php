@extends('layouts.teacher')

@section('title')
    Αναζήτηση Ομάδας
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <section id="content">
        <div class="bottom-section">
            <a href="{{route('groups')}}">Back</a>
            <p class="title purple">Αναζήτηση Ομάδας</p>
            <form action="{{route('group.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-md-2">
                        <button type="submit" class="button light">ΑΝΑΖΗΤΗΣΗ</button>
                    </div>
                </div>
            </form>


            @if(count($groups) > 0)
                <table>
                    <thead>
                    <tr class="tableRow colTitles">
                        <th>Τίτλος</th>
                        <th>Περιγραφή</th>
                        <th>Μάθημα</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($groups as $group)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <a href="{{route('group.show' , ['group' => $group])}}"><p
                                        class="paragraph">{{$group->title}}</p></a>
                            </td>
                            <td class="col-md-5">
                                <a href="{{route('group.show' , ['group' => $group])}}"><p
                                        class="paragraph">{{substr($group->summary, 0,130)}}...</p></a>
                            </td>
                            <td class="col-md-3">
                                <a href="{{route('group.show' , ['group' => $group])}}"><p
                                        class="paragraph">{{$group->subject->title}}ο Εξάμηνο</p></a>
                            </td>
                            <td>
                                <a href="{{route('group.edit' , ['group' => $group])}}" class="edit"><i
                                        class="fa-regular fa-pencil"></i></a>
                            </td>
                            <td>
                                <a href="{{route('group.delete', ['group' => $group])}}" class="delete"><i
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

