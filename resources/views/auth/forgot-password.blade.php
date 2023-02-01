@extends('layouts.front')
@section('content')
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="content flex items-center flex-col mt-20">
                    <div class="flex col-md-6 items-center gap-x-8">
                        <a href="{{route('login')}}"><div style="background-image: url({{ asset('assets/img/logo_white.png') }})" class="logo"></div></a>
                        <div class="header mt-12">Επαναφορά Κωδικού</div>
                    </div>
                    <div class="card-body col-md-6">
                        <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <!-- Email Address -->
                            <div class="input">
                                <label for="email" class="input-label">Email</label>
                                <input id="email" class="text-input" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Password -->
                            <div class="buttons">
                                <button class="button bold">Αποστολή Κωδικού</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
