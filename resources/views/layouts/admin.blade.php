<!doctype html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300;400;500;600;700&display=swap"
          rel="stylesheet">
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
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('stylesheets')
    <link rel="stylesheet" href="{{asset("css/styles.css")}}">
    <title>@yield('title') - eClass Dashboard</title>

</head>
<body class="is-front {{Request::path()}}">


@yield('homeheader')
<section id="main">
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-header col-md-6">
                <a href="{{route('dashboard')}}" class="logoLink">
                    <div style="background-image: url({{ asset('assets/img/logo.png') }})" class="logo"></div>
            </a>
            </div>
            <div class="list-container col-md-6">
                <ul class="nav-bar">
                    <li class="nav-item">
                        <a href="{{route('teacher.invite')}}" class="menu"><i class="fa-solid fa-user-tie"></i>Καθηγητές</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('student.invite')}}" class="menu"><i class="fa-solid fa-clipboard-user"></i>Φοιτητές</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('students')}}" class="menu"><i class="fa-solid fa-message-dots"></i>Μυνήματα</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('email')}}" class="menu"><i class="fa-solid fa-books"></i>Μαθήματα</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('change.password.view')}}" class="menu"><i class="fa-solid fa-user"></i>Χρήστης</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('signout')}}" class="menu"><i class="fa-solid fa-arrow-right-from-bracket"></i> Αποσύνδεση</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
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
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true,
            "timeOut": "5000",
            "progressBar": true,
            "extendedTimeOut": "5000"
        }
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @elseif(Session::has('warning'))
        toastr.warning('{{ Session::get('warning') }}');
        @endif
    });
</script>
@yield('javascripts')
</body>
</html>
