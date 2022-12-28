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
            <a href="{{route('homework')}}">Back</a>
            <p class="title purple">Αναζήτηση Μαθήματος</p>
            <form action="{{route('homework.search.form')}}" method="POST">
                @csrf
                <div class="row addForm">
                    <input class="search text-input col-md-12" name="search" type="text" minlength="4"
                           placeholder="Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες...">
                    <div class="col-md-2">
                        <button type="submit" class="button light">ΑΝΑΖΗΤΗΣΗ</button>
                    </div>
                </div>
            </form>


            @if(count($homework) > 0)
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

                    @foreach($homework as $single)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <a href="{{route('homework.show' , ['homework' => $single])}}"><p
                                        class="paragraph">{{$single->title}}</p></a>
                            </td>
                            <td class="col-md-5">
                                <a href="{{route('homework.show' , ['homework' => $single])}}"><p
                                        class="paragraph">{{substr($single->summary, 0,130)}}...</p></a>
                            </td>
                            <td class="col-md-3">
                                <a href="{{route('homework.show' , ['homework' => $single])}}"><p
                                        class="paragraph">{{$single->subject->title}}</p></a>
                            </td>
                            <td>
                                <a href="{{route('homework.edit' , ['homework' => $single])}}" class="edit"><i
                                        class="fa-regular fa-pencil"></i></a>
                            </td>
                            <td>
                                <a href="{{route('homework.delete', ['homework' => $single])}}" class="delete"><i
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

