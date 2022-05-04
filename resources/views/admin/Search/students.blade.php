@extends('layouts.admin')

@section('title')
    Αναζήτηση Καθηγητή
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
@endsection


@section('content')
    <section id="content">
        <div class="search-header">
            <div class="search-header-container">
                <h3>Αναζήτηση Καθηγητή</h3>
                <form action="{{route('student.search.form')}}" method="POST">
                    @csrf
                    <input class="search my-input" name="search" type="text" minlength="4">
                    <div class="helper">Παρακαλώ συμπληρώστε τουλάχιστον 4 χαρακτήρες</div>
                    <button type="submit">ΑΝΑΖΗΤΗΣΗ</button>
                </form>
            </div>
        </div>

        <div class="search-results-container">
            <div class="results-list">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="list-item">
                            <a href="{{route('student.show', ['student' => $user])}}">
                                <div class="details">
                                    <div>'Ονομα: {{$user->surname}} {{$user->name}}</div>
                                    <div>Εμαιλ: {{$user->email}}</div>
                                    <div>Τμήμα: {{$user->domain->name}}</div>
                                    <div>Αριθμός Μητρώου: {{$user->student->am}}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection

