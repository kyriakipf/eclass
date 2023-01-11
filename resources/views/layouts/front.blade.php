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
    <link rel="stylesheet" href="{{asset("css/styles.css")}}">
    <link rel="stylesheet" href="{{asset("css/login.css")}}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>eClass - Σύνδεση Χρήστη</title>

    @yield('stylesheets')
</head>
<body class="is-front">
@yield('header')
@yield('content')
@yield('footer')
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
            "extendedTimeOut": "5000",
            "positionClass": 'toast-bottom-right'
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
