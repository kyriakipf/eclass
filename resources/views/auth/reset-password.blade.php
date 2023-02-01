@extends('layouts.front')
@section('content')
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="content col-md-4">
                    <p class="header">Δημιουργία Καινούργιου Κωδικού</p>
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

