@extends('layouts.teacher')

@section('title')
    Αναζήτηση Μαθήματος
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <div class="mainInfo">
        <div class="top-section row col-md-12"></div>
        <div class="bottom-section">
            <div class="col-md-auto">
                <div class="flex">
                    <p class="title" style="margin-bottom: 0 !important;">Εργασίες</p>
                </div>
            </div>
            @if(!isset($subject))
                {{$subject = null}}
            @endif
            <form action="{{route('homework.search.form', ['subject' => $subject])}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" id="search" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-auto">
                        <button type="submit" class="light minimalButton"><i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
            <table>
                <thead>
                @if(count($homework) > 0)
                    <tr class="tableRow colTitles">
                        <th class="sort">Τιτλος</th>
                        <th class="sort">Περιγραφη</th>
                        <th class="sort">Μάθημα</th>
                        <th class="sort">Είδος Εργασίας</th>
                        <th class="sort">Προθεσμία</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                @foreach($homework as $single)
                    <tr class="tableRow">
                        <td>
                            <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}">
                                <p class="paragraph">{{$single->title}}</p></a>
                        </td>
                        <td >
                            <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}"><p
                                    class="paragraph">{{substr($single->summary, 0,130)}}...</p></a>
                        </td>
                        <td >
                            <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}"><p
                                    class="paragraph">{{$single->subject->title}}</p></a>
                        </td>
                        <td >
                            <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}"><p
                                    class="paragraph">{{$single->homework_type}}</p></a>
                        </td>
                        <td >
                            <a href="{{route('homework.show', ['homework' => $single, 'subject' => $single->subject])}}"><p
                                    class="paragraph">{{\Carbon\Carbon::parse($single->due_date)->format('d-m-Y')}}</p>
                            </a>
                        </td>
                        <td >
                            <a href="{{route('homework.edit', ['homework' => $single])}}" class="edit"><i
                                    class="fa-regular fa-pencil"></i></a>
                        </td>
                        <td >
                            <a href="{{route('homework.delete', ['homework' => $single])}}"
                               class="delete"><i
                                    class="fa-regular fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <div class="tableRow">
                    <p class="paragraph">Δεν
                        υπάρχουν διαθέσιμες εργασίες.</p>
                </div>
            @endif
        </div>
@endsection

