<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CubaBien | @yield('title')</title>

    <link rel="stylesheet" href="{{ assets_frontend('css/cubabien.css') }}">
    <!-- CSS Style -->
    <link href="{{ assets_frontend('css/cubabien.css') }}" rel="stylesheet">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ assets_frontend('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ assets_frontend('img/favicon.ico') }}" type="image/x-icon">
    @yield('css')
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"></div>
</div>
<!-- Preloader End-->
    @include('frontend.layouts.header')
    {{--Content Per Page--}}
    @yield('content')
    {{--Content Per Page End--}}
    @include('frontend.layouts.footer')

<!-- JScript -->
<script src="{{assets_frontend('js/cubabien.js')}}"></script>
<script type="text/javascript">
    $("ul.dropdown-menu>li").on("click", ".idioma-select", function () {
       let lang = $(this).data("lang");
       App.initAjaxFront();
        $.ajax({
            type: 'POST',
            url: "{!! url('lang') !!}",
            data: {
                'lang': lang,
            },
            success: function (data) {
                if (data.mensaje==="OK") {
                    window.location.reload(true);
                }
            },
        });
    });
</script>
@yield('js')
</body>
</html>