@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/groupAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">{{$homework->title}} </p>
                        <p class="smallTitle mt-2">&ensp; {{$homework->subject->semester->number}}<small>o</small>
                            Εξάμηνο </p>
                    </div>
                    <p class="paragraph mt-1">
                        {{$homework->user->name}} {{$homework->user->surname}} | Είδος: {{$homework->homework_type}} |
                        Μέγιστη Βαθμολογία: {{$homework->max_grade}}

                    </p>
                    <p class="paragraph mt-1">
                        Προθεσμία: {{\Carbon\Carbon::parse($homework->due_date)->format('d-m-Y')}}
                    </p>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('student.subject.homework.show' , ['subject' => $homework->subject])}}">Επιστροφή</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row">
                <div class="flex mt-3">
                    <div class="summary">
                        <p class="subtitle">Περιγραφή</p>
                        @if($homework->summary != null)
                            <p class="paragraph collapsable">{{$homework->summary}}</p>
                            @if(strlen($homework->summary) > 5300)
                                <span class="show-more">Περισσότερα...</span>
                                <span class="show-less">Λιγότερα...</span>
                            @endif
                        @else
                            <p class="paragraph">Δεν υπάρχει διαθέσιμη περιγραφή.</p>
                        @endif
                    </div>
                </div>
                <div class="flex mt-5 gap-4">
                    @if($homework->filepath != null)
                        <div class="col-auto">
                            <p>Αρχείο Εργασίας:</p>
                            <p>{{basename($homework->filepath)}}
                                <a href="{{asset('storage/' . $homework->filepath)}}" class="ml-3" target="_blank">
                                    <i class="fa-regular fa-eye text-lg"></i>
                                </a>
                                <a href="{{route('student.homework.file.download', [ 'homework' => $homework])}}"
                                   class="ml-3">
                                    <i class="fa-regular fa-download text-lg"></i>
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
                <p class="subtitle">Προσθήκη Αρχείου</p>
                <p class="paragraph">Εαν έχετε ήδη ανεβάσει αρχείο και ανεβάσετε πάλι, το προηγούμενο αρχείο θα
                    διαγραφεί.</p>
                <form action="{{route('student.homework.file.store',['homework' => $homework])}}" method="post"
                      enctype="multipart/form-data" class="mt-2">
                    @csrf
                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <div class="btn-container col-md-2">
                        <button type="submit" class="button bold ">Προσθήκη Αρχείου</button>
                    </div>
                </form>
                <div>
                    @if($selfFile != null)
                        <p class="subtitle">Ανεβασμένο Αρχείο</p>
                        <a href="{{route('student.homework.selffile.download', [ 'homework' => $homework])}}">{{$selfFile}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
        const s = $.noConflict();
        s(document).ready(function () {
            s('.collapsable').css({"maxHeight": "500px"})
            s('.show-less').hide()
            s('.show-more').on('click', function () {
                s('.collapsable').css({"maxHeight": "unset"})
                s('.show-more').hide()
                s('.show-less').show()
            })
            s('.show-less').on('click', function () {
                s('.collapsable').css({"maxHeight": "500px"})
                s('.show-more').show()
                s('.show-less').hide()
            })
        });
    </script>
@endsection
