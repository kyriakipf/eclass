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
                    <p class="header">Δημιουργία κωδικού στο eClass.</p>
                    <p class="comment">Πλατφόρμα Τηλεκπαίδευσης.</p>
                    <div class="card-body">
                        <form method="POST" @if($invite->role_id == 2) action="{{ route('teacher.store' ,$invite) }}" @elseif($invite->role_id == 3) action="{{ route('student.store' , $invite) }}" @endif>
                        @csrf
                        <!-- Email Address -->
                            <div class="input">
                                <label for="email" class="input-label">Email</label>
                                <input id="email" class="text-input" type="email" name="email" value="{{$invite->email}}" readonly/>
                            </div>
                            <!-- Password -->
                            <div class="input">
                                <label for="password" class="input-label">Κωδικός</label>
                                <input id="password" class="text-input" type="password" name="password" required
                                       autocomplete="current-password"/>
                            </div>
                            <div class="buttons">
                                <button class="button bold">Δημιουργία Κωδικού</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
