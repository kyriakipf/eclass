<!doctype html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="https://use.typekit.net/epx6djf.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/fontawesome.css")}}">
    <link rel="stylesheet" href="{{asset("css/brands.css")}}">
    <link rel="stylesheet" href="{{asset("css/duotone.css")}}">
    <link rel="stylesheet" href="{{asset("css/light.css")}}">
    <link rel="stylesheet" href="{{asset("css/regular.css")}}">
    <link rel="stylesheet" href="{{asset("css/solid.css")}}">
    <link rel="stylesheet" href="{{asset("css/thin.css")}}">
    <link rel="stylesheet" href="{{asset("css/v4-shims.css")}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('stylesheets')
    <link rel="stylesheet" href="{{asset("css/styles.css")}}">
    <title>@yield('title') - eClass Dashboard</title>

</head>
<body class="is-front {{Request::path()}}">


@yield('homeheader')
<section id="main">
    <div class="dashboard">
        <div class="sidebar col-md-3">
            <div class="sidebar-header">
                <a href="{{route('dashboard')}}"><i class="fa-solid fa-graduation-cap"></i> eClass</a>
            </div>
            <hr>
{{--            @include('navigation')--}}
            <div class="list-container">
            <ul class="nav-bar">
                <p>Επεξεργασία Χρηστών</p>
                <li class="nav-item">
                    <a href="{{route('teacher.invite')}}"><i class="fa-light fa-edit"></i> Πρόσκληση Καθηγητών</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('teachers')}}"><i class="fa-light fa-edit"></i> Επεξεργασία Εγγεγραμμένων Καθηγητών</a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="{{route('student.invite')}}"><i class="fa-light fa-edit"></i> Πρόσκληση Φοιτητών</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('students')}}"><i class="fa-light fa-edit"></i> Επεξεργασία Εγγεγραμμένων Φοιτητών</a>
                </li>
                <hr>
                <p>Μηνύματα</p>
                <li class="nav-item">
                    <a href="{{route('email')}}"><i class="fa-light fa-envelope"></i> Δημιουργία</a>
                </li>
            </ul>
            <hr>
            <ul class="nav-bar user-options">
                <li class="nav-item">
                    <a href="{{route('change.password.view')}}"><i class="fa-solid fa-key"></i> Change Password</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('signout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> LogOut</a>
                </li>
            </ul>
            </div>
        </div>
        <div class="content col-md-9">
            <div class="content-container">
                @yield('content')
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{asset("js/bootstrap.js")}}"></script>
<script src="{{asset("js/theme-scripts.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @endif
    });
</script>
@yield('javascripts')
</body>
</html>
