<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
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
    @include('backend.layouts.sidebar')
    @include('backend.layouts.header')


    <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>@yield('title_content')</h3>
                    </div>

                <!-- Search Box a la derecha -->
                    {{--<div class="title_right">--}}
                        {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                                {{--<span class="input-group-btn">--}}
                      {{--<button class="btn btn-default" type="button">Go!</button>--}}
                    {{--</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                <!-- Search Box acaba -->
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {{--mirar abajo--}}
                        @yield('content')

                        {{--<div class="x_panel">--}}
                            {{--<div class="x_title">--}}
                                {{--<h2>Plain Page</h2>--}}
                                {{--<ul class="nav navbar-right panel_toolbox">--}}
                                    {{--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
                                    {{--</li>--}}
                                    {{--<li class="dropdown">--}}
                                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                                           {{--aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                                        {{--<ul class="dropdown-menu" role="menu">--}}
                                            {{--<li><a href="#">Settings 1</a>--}}
                                            {{--</li>--}}
                                            {{--<li><a href="#">Settings 2</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                    {{--<li><a class="close-link"><i class="fa fa-close"></i></a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</div>--}}
                            {{--<div class="x_content">--}}
                                {{--Add content to the page ...--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->


    </div>
</div>
<!-- JScript -->
<script src="{{assets_backend('js/cubabien.js')}}"></script>
@yield('js')
</body>
</html>