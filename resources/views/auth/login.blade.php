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
                    <h1>Σύνδεση στο eClass.</h1>
                    <p>Πλατφόρμα Τηλεκπαίδευσης.</p>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                            <div class="input">
                                <label for="email">Email</label>
                                <input id="email" class="textInput" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Password -->
                            <div class="input">
                                <label for="password">Κωδικός</label>
                                <input id="password" class="textInput" type="password" name="password" required
                                       autocomplete="current-password"/>
                            </div>
                            <div class="buttons">
                                @if (Route::has('password.request'))
                                    <a class="forgotBtn"
                                       href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                @endif
                                <button class="button bold">Σύνδεση</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
