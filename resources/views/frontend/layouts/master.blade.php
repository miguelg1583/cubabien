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
    <link rel="shortcut icon" href="{{ assets_frontend('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ assets_frontend('images/favicon.png') }}" type="image/x-icon">
    @yield('css')
</head>

<body>
{{--<!-- Preloader -->--}}
{{--<div id="preloader">--}}
    {{--<div id="status"></div>--}}
{{--</div>--}}
{{--<!-- Preloader End-->--}}
@include('frontend.layouts.header')
{{--Content Per Page--}}
@yield('content')
{{--Content Per Page End--}}
@include('frontend.layouts.footer')

{{--el carrito--}}
<div class="cd-cart-container empty">
    <a href="#0" class="cd-cart-trigger">
        Cart
        <ul class="count"> <!-- cart items count -->
            <li>0</li>
            <li>0</li>
        </ul> <!-- .count -->
    </a>

    <div class="cd-cart">
        <div class="wrapper">
            <header>
                <h2>Cart</h2>
                <span class="undo">Item removed. <a href="#0">Undo</a></span>
            </header>

            <div class="body">
                <ul>
                    <!-- products added to the cart will be inserted here using JavaScript -->
                </ul>
            </div>

            <footer>
                <a href="#0" class="checkout btn"><em>Checkout - $<span>0</span></em></a>
            </footer>
        </div>
    </div> <!-- .cd-cart -->
</div> <!-- cd-cart-container -->

<!-- JScript -->
<script src="{{assets_frontend('js/cubabien.js')}}"></script>
<script type="text/javascript">
    $(document).ready(() => {
        App.initAjaxFront();
        App.showNotiInfoFull('{!! __("noti-info.title")!!}', '{!! __("noti-info.mensaje-desarrollo")!!}');
        if(window.innerWidth < 1480){
            $('.logo-display')[0].src="{{assets_frontend('images/logo-white.png')}}";
        }
    });
    $("ul.dropdown-menu>li").on("click", ".idioma-select", function () {
        let lang = $(this).data("lang");
        $.ajax({
            type: 'POST',
            url: "{!! url('lang') !!}",
            data: {
                'lang': lang,
            },
            success: function (data) {
                if (data.mensaje === "OK") {
                    window.location.reload(true);
                }
            },
        });
    });
    $('img').on('mousedown', function (event) {
        if (event.which === 3) {
            let self = this;
            if (self.src.indexOf('_watermark') === -1) {
                self.src = self.src.replace('.jpg', '_watermark.jpg');
            }
        }
    }).on('tapstart', function (e, touch) {
        if (this.src.indexOf('_watermark') === -1) {
            this.src = this.src.replace('.jpg', '_watermark.jpg');
        }
    })
</script>
@yield('js')
</body>
</html>