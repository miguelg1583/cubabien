<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CubaBien Admin | @yield('title')</title>

    <link rel="stylesheet" href="{{ assets_backend('css/cubabien.css') }}">
    <link rel="shortcut icon" href="{{ assets_backend('img/favicon.ico') }}"/>
    @yield('css')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @yield('content')
    </div>
</div>

<script src="{{assets_backend('js/cubabien.js')}}"></script>
@yield('js')
</body>
</html>