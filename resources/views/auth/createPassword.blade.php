@extends('layouts.front')
@section('content')
    <!-- Session Status -->
    {{--    <x-auth-session-status class="mb-4" :status="session('status')"/>--}}

    {{--    <!-- Validation Errors -->--}}
    {{--    <x-auth-validation-errors class="mb-4" :errors="$errors"/>--}}
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="content col-md-4">
                    <h1>Δημιουργία κωδικού στο eClass.</h1>
                    <p>Πλατφόρμα Τηλεκπαίδευσης.</p>
                    <div class="card-body">
                        <form method="POST" @if($invite->role_id == 2) action="{{ route('teacher.store' ,$invite) }}" @elseif($invite->role_id == 3) action="{{ route('student.store' , $invite) }}" @endif>
{{--                        <form method="POST" action="{{ route('teacher.store' ,$invite) }}">--}}
                        @csrf
                        <!-- Email Address -->
                            <div class="input">
                                <label for="email">Email</label>
                                <input id="email" class="textInput" type="email" name="email" value="{{$invite->email}}" readonly/>
                            </div>
                            <!-- Password -->
                            <div class="input">
                                <label for="password">Κωδικός</label>
                                <input id="password" class="textInput" type="password" name="password" required
                                       autocomplete="current-password"/>
                            </div>
                            <div class="buttons">
                                <button class="loginBtn">Δημιουργία Κωδικού</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
