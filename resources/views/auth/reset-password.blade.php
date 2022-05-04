{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('password.update') }}">--}}
{{--            @csrf--}}

{{--            <!-- Password Reset Token -->--}}
{{--            <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--            <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password" :value="__('Password')" />--}}

{{--                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />--}}
{{--            </div>--}}

{{--            <!-- Confirm Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--                <x-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                    type="password"--}}
{{--                                    name="password_confirmation" required />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <x-button>--}}
{{--                    {{ __('Reset Password') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}

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
                    <h1>Δημιουργία Καινούργιου Κωδικού</h1>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <!-- Email Address -->
                            <div class="input">
                                <label for="email">Email</label>
                                <input id="email" class="textInput" type="email" name="email"  value="{{$request->email}}" readonly/>
                            </div>
                            <!-- Password -->
                            <div class="input">
                                <label for="password">Κωδικός</label>
                                <input id="password" class="textInput" type="password" name="password" required
                                       autocomplete="current-password"/>
                            </div>
                            <div class="input">
                                <label for="password_confirmation">Επαλήθευση Κωδικού</label>
                                <input id="password_confirmation" class="textInput" type="password" name="password_confirmation" required
                                       autocomplete="current-password"/>
                            </div>
                            <div class="buttons">
                                <button class="loginBtn">Αποθήκευση Κωδικού</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

