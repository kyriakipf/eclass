@extends('layouts.front')
@section('content')
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="content col-md-4">
                    <p class="header">Επαναφορά Κωδικού</p>
                    <div class="card-body">
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
