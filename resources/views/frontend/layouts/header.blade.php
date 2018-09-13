<!-- Start Navigation -->
<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
    <div class="container-fluid">
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#brand">
                <img src="{{assets_frontend('images/logo-white.png')}}" class="logo logo-display" alt="">
                <img src="{{assets_frontend('images/logo-black.png')}}" class="logo logo-scrolled" alt="">
            </a>
        </div>
        <!-- End Header Navigation -->
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
                <li class="button">
                    <a href="{{route('static_page',['contact_us'])}}" class="button btn btn-md btn-default btn-outline-dark radius5">
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
                    <a href="#" class="submenu {{ Route::is('travel_cuba') ? 'active' : '' }}">{{__('menu.travel_cuba')}}</a>
                </li>
                <li>
                    <a href="#" class="submenu {{ Route::is('lodging') ? 'active' : '' }}">{{__('menu.lodging')}}</a>
                </li>
                <li>
                    <a href="#" class="submenu {{ Route::is('visa') ? 'active' : '' }}">{{__('menu.visa')}}</a>
                </li>
                <li>
                    <a href="#" class="submenu {{ Route::is('flights') ? 'active' : '' }}">{{__('menu.flights')}}</a>
                </li>
                <li>
                    <a href="#" class="submenu {{ Route::is('transfer') ? 'active' : '' }}">{{__('menu.transfer')}}</a>
                </li>
                <li>
                    <a href="#" class="submenu {{ Route::is('rent_car') ? 'active' : '' }}">{{__('menu.rent_car')}}</a>
                </li>
                <li>
                    <a href="#" class="{{ Route::is('exper') ? 'active' : '' }}">{{__('menu.exper')}}</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="submenu dropdown-toggle active" data-toggle="dropdown">{{__('menu.lang')}}</a>
                    <ul class="dropdown-menu">
                        @foreach ($idiomas as $idioma)
                            <li>
                                <a href="#" class="idioma-select" data-lang="{{$idioma->sigla}}">{{$idioma->nombre}}</a>
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
            <h6 class="title">About Kanina</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque ex molestiae molestias voluptatum dignissimos
                sint porro eveniet cupiditate autem saepe, obcaecati error numquam possimus vel omnis consequatur et.
                Officiis, quo.</p>
        </div>
        <div class="widget">
            <h6 class="title">Contact Us</h6>
            <ul class="link">
                <li>
                    <a href="#">Send a ticket</a>
                </li>
                <li>
                    <a href="#">LiveChat</a>
                </li>
                <li>
                    <a href="#">Get Directions</a>
                </li>
                <li>
                    <a href="mailto:hello@youremail.com">Email : hello@youremail.com</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Side Menu -->
</nav>
<!-- End Navigation -->