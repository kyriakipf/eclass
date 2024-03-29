@extends('layouts.teacher')

@section('title')
    Αναζήτηση Ομάδας
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <div class="top-section row">
        <div class=" main-info flex justify-start align-baseline">
            <div class="col-md-auto">
                <div class="flex">
                    <p class="title" style="margin-bottom: 0 !important;">Ομάδες</p>
                </div>
                <p class="paragraph mt-1">
                    <a href="{{route('group.create', ['subject' => $subject])}}" class="paragraph">Προσθήκη</a>
                </p>
            </div>
            <div class="col-md-1 ml-auto">
                <a href="{{route('subject.show' , ['subject' => $subject])}}">Επιστροφή</a>
            </div>
        </div>
    </div>
    <div class="bottom-section">
        <form action="{{route('group.search.form', ['subject' => $subject])}}" method="POST">
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


        <table>
            @if(count($groups) != 0)
                <thead>
                <tr class="tableRow colTitles">
                    <th class="sort">Τιτλος</th>
                    <th class="sort">Περιγραφη</th>
                    <th class="sort">Μάθημα</th>
                    <th class="sort">Μέγιστος Αριθμός Εγγραφών</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr class="tableRow">
                        <td>
                            <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                <p class="paragraph">{{$group->title}}</p></a>
                        </td>
                        <td>
                            <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                <p
                                    class="paragraph">{{substr($group->summary, 0,130)}}...</p></a>
                        </td>
                        <td >
                            <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                <p
                                    class="paragraph">{{$group->subject->title}}</p></a>
                        </td>
                        <td>
                            <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                <p
                                    class="paragraph">{{count($group->student)}}/{{$group->capacity}}</p></a>
                        </td>
                        <td >
                            <a href="{{route('group.edit', ['group' => $group, 'subject' => $group->subject])}}"
                               class="edit"><i
                                    class="fa-regular fa-pencil"></i></a>
                        </td>
                        <td >
                            <a href="{{route('group.delete', ['group' => $group])}}"
                               class="delete"><i
                                    class="fa-regular fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                @else
                    <p class="comment">Δεν υπάρχουν σχετικά αποτελέσματα...</p>
                </tbody>
            @endif
        </table>
    </div>
@endsection

