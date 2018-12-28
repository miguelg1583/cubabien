<!-- Start Navigation -->
<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
    <div class="container-fluid">
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#brand">
                <img src="{{assets_frontend('images/logo-white179.png')}}" class="logo logo-display" alt="">
                <img src="{{assets_frontend('images/logo-black.png')}}" class="logo logo-scrolled" alt="">
            </a>
        </div>
        <!-- End Header Navigation -->
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
                <li class="button">
{{--                    <a href="{{route('static_page',['contact_us'])}}" class="button btn btn-md btn-default btn-outline-dark radius5">--}}
                    <a href="{{route('contact_us.index')}}" class="button btn btn-md btn-default btn-outline-dark radius5">
                        <i class="fa fa-user fa-lg"></i>{{__('menu.contact')}}</a>
                </li>
                <li class="button">
                    <a href="{{route('faq.index')}}" class="button btn btn-md btn-default btn-outline-dark radius5">
                        <i class="fa fa-question fa-lg"></i>{{__('menu.faq')}}</a>
                </li>
                <li class="side-menu">
                    <a href="#">
                        {{__('menu.travel_agent')}}
                        <i class="fa fa-align-right fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Atribute Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-left" data-in="slideInUp" data-out="slideOutUp">
                <li>
                    <a href="{{route('home')}}" class="submenu {{ Route::is('home') ? 'active' : '' }}">{{__('menu.home')}}</a>
                </li>
                <li>
                    <a href="{{route('travel_cuba.index')}}" class=" {{ Request::is('travel_cuba*') ? 'active' : '' }}">{{__('menu.travel_cuba')}}</a>
                </li>
                <li>
                    <a href="#" class=" {{ Request::is('lodging') ? 'active' : '' }}">{{__('menu.lodging')}}</a>
                </li>
                <li>
                    <a href="#" class=" {{ Request::is('visa') ? 'active' : '' }}">{{__('menu.visa')}}</a>
                </li>
                <li>
                    <a href="#" class=" {{ Request::is('flights') ? 'active' : '' }}">{{__('menu.flights')}}</a>
                </li>
                <li>
                    <a href="#" class=" {{ Request::is('transfer') ? 'active' : '' }}">{{__('menu.transfer')}}</a>
                </li>
                <li>
                    <a href="#" class=" {{ Request::is('rent_car') ? 'active' : '' }}">{{__('menu.rent_car')}}</a>
                </li>
                <li>
                    <a href="#" class=" {{ Request::is('exper') ? 'active' : '' }}">{{__('menu.exper')}}</a>
                </li>
                <li class="dropdown">
                    <a href="#idiom-{!! $idiomas[0]->id !!}" class="submenu dropdown-toggle active" data-toggle="dropdown">{{__('menu.lang')}}</a>
                    <ul class="dropdown-menu">
                        @foreach ($idiomas as $idioma)
                            <li>
                                <a id="idiom-{!! $idioma->id !!}" href="javascript:;" class="idioma-select" data-lang="{{$idioma->sigla}}">{{$idioma->nombre}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>

    <!-- Start Side Menu -->
    <div class="side">
        <a href="#" class="close-side">
            <i class="fa fa-times"></i>
        </a>
        <div class="widget">
            <h6 class="title">{!! __('travel-agent.title') !!}</h6>
            <p>{!! __('travel-agent.p1') !!}</p>
            <br>
            {!! __('travel-agent.lista') !!}
            <br>
            <p>{!! __('travel-agent.p2') !!}</p>
            <p><a href="#">{!! __('travel-agent.login') !!}</a> / <a href="{{route('travel_agent.showRegistrationForm')}}">{!! __('travel-agent.register') !!}</a></p>
        </div>
        <div class="widget">
            <h6 class="title">{{__('menu.contact')}}</h6>
            <p>7360 SW 24th St #22</p>
            <p>Miami, FL 33155, USA</p>
            <a href="mailto:agent@cubabientravel.com">agent@cubabientravel.com</a>
            <div class="social-links">
                <a href="https://facebook.com/Cubabien">
                    <i class="fa fa-facebook-f fa-md"></i>
                </a>
                <a href="https://twitter.com/cubabientravel">
                    <i class="fa fa-twitter fa-md"></i>
                </a>
                <a href="https://www.instagram.com/cubabientravel/">
                    <i class="fa fa-instagram fa-md"></i>
                </a>
                <a href="https://plus.google.com/111594830073416892444/posts">
                    <i class="fa fa-google-plus fa-md"></i>
                </a>
                <a href="mailto:agent@cubabientravel.com">
                    <i class="fa fa-envelope fa-md"></i>
                </a>
            </div>
            <p>"Fla. Seller of Travel Ref. No. ST38416"</p>
        </div>
    </div>
    <!-- End Side Menu -->
</nav>
<!-- End Navigation -->