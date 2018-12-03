<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('dashboard')}}" class="site_title">
                {{--<i class="fa fa-paw"></i>--}}
                <img src="{{assets_backend('images/icon.png')}}">
                <span>CubaBien Admin</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{assets_backend('images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-language"></i> Traducciones <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('traduccion.index')}}">Listado</a></li>
                            <li><a href="{{route('traduccion.create')}}">Agregar</a></li>
                            <li><a href="#">Idiomas</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-question"></i> FAQ's <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a>Categorias<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('categoria-faq.index')}}">Listado</a></li>
                                    <li><a href="{{route('categoria-faq.create')}}">Agregar</a></li>
                                </ul>
                            </li>
                            <li><a>Preguntas y Respuestas<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('pregunta-resp.index')}}">Listado</a></li>
                                    <li><a href="{{route('pregunta-resp.create')}}">Agregar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('contact.index')}}"><i class="fa fa-envelope"></i> Mensajes</a>
                    </li>
                    <li><a><i class="fa fa-binoculars"></i> Tours <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('tour.index')}}">Listado</a></li>
                            <li><a href="{{route('tour.create')}}">Agregar</a></li>
                            <li><a>Itinerarios<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('itinerario-tour.index')}}">Linea de Tiempo</a></li>
                                    <li><a href="{{route('itinerario-tour.index_datatable')}}">Listado</a></li>
                                    <li><a href="{{route('itinerario-tour.create')}}">Agregar</a></li>
                                </ul>
                            </li>
                            <li><a>Calendarios<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('calendario-tour.index')}}">Calendario</a></li>
                                    <li><a href="{{route('calendario-tour.index_datatable')}}">Listado</a></li>
                                    <li><a href="{{route('calendario-tour.create')}}">Agregar</a></li>
                                </ul>
                            </li>
                            <li><a>Mapas<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('mapa-tour.index')}}">Listado</a></li>
                                    <li><a href="{{route('mapa-tour.create')}}">Agregar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-image"></i> Imágenes <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('imagen.upload')}}">Subir</a></li>
                            <li><a href="javascript:void;">Galería</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>