@extends('layouts.front')
@section('content')
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="content col-md-4">
                    <h1>Επαναφορά Κωδικού</h1>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <!-- Email Address -->
                            <div class="input">
                                <label for="email">Email</label>
                                <input id="email" class="textInput" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Password -->
                            <div class="buttons">
                                <button class="loginBtn">Αποστολή Κωδικού</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
