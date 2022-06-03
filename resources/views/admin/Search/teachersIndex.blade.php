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
        </div>
    </section>
@endsection
