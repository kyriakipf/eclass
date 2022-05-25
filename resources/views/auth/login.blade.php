@extends('layouts.front')
@section('content')
    <section id="login">
        <div class="container">
            <div class="row">
                <div style="background-image: url({{ asset('assets/img/logo_white.png') }})" class="logo"></div>
                <div class="card-body col-md-7">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="input col-md-12">
                            <label for="email">Email</label>
                            <input id="email" class="textInput" type="email" name="email" required autofocus/>
                        </div>
                        <!-- Password -->
                        <div class="input col-md-12">
                            <label for="password">Κωδικός</label>
                            <input id="password" class="textInput" type="password" name="password" required
                                   autocomplete="current-password"/>
                        </div>
                        <div class="buttons col-md-6">
                            @if (Route::has('password.request'))
                                <a class="forgotBtn"
                                   href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                            @endif
                            <button class="button bold">Σύνδεση</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="credits">
                <p>Πτυχιακή: Ανάπτυξη Εφαρμογής eClass. <br>Developed by Kyriaki Prifti</p>
                <i class="fa-solid fa-robot"></i>
            </div>
            <div style="background-image: url({{ asset('assets/img/boy.png') }})" class="boy"></div>
        </div>
    </section>
@endsection
