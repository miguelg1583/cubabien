<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CubaBien Admin | Login</title>

    <link rel="stylesheet" href="{{ assets_backend('css/cubabien.css') }}">
    <link rel="shortcut icon" href="{{ assets_backend('img/favicon.ico') }}"/>
</head>
<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required />
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required />
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit">Iniciar Sesión</button>
                        <a class="reset_pass" href="{{ route('password.request') }}">Olvidó su Contraseña?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        {{--<p class="change_link">New to site?--}}
                            {{--<a href="#signup" class="to_register"> Create Account </a>--}}
                        {{--</p>--}}
                        <div class="clearfix"></div>
                        <br />

                        <div>
                            {{--<h1><i class="fa fa-paw"></i> Cubabien Travel</h1>--}}
                            <img src="{{assets_backend('images/icon_dark.png')}}">
                            <p>©2018 All Rights Reserved.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        {{--<div id="register" class="animate form registration_form">--}}
            {{--<section class="login_content">--}}
                {{--<form>--}}
                    {{--<h1>Create Account</h1>--}}
                    {{--<div>--}}
                        {{--<input type="text" class="form-control" placeholder="Username" required="" />--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="email" class="form-control" placeholder="Email" required="" />--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="password" class="form-control" placeholder="Password" required="" />--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<a class="btn btn-default submit" href="index.html">Submit</a>--}}
                    {{--</div>--}}

                    {{--<div class="clearfix"></div>--}}

                    {{--<div class="separator">--}}
                        {{--<p class="change_link">Already a member ?--}}
                            {{--<a href="#signin" class="to_register"> Log in </a>--}}
                        {{--</p>--}}

                        {{--<div class="clearfix"></div>--}}
                        {{--<br />--}}

                        {{--<div>--}}
                            {{--<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>--}}
                            {{--<p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</section>--}}
        {{--</div>--}}
    </div>
</div>
{{--<script src="{{assets_backend('js/cubabien.js')}}"></script>--}}
</body>
</html>
