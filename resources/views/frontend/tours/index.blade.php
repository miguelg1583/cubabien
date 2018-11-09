@extends('frontend.layouts.master')

@section('title', __('menu.travel_cuba'))

@section('css')
@endsection

@section('content')
    <div class="header1 contact-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="text-container text-left">
                        <h2>{{__('menu.travel_cuba')}}</h2>
                        <p>{!! __('tour.header-p') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header 1 end -->
    <!-- colors -->
    <div class="colors">
        <div class="no-padding container-fluid">
            <span class="col-sm-3 col-xs-3 color1"></span>
            <span class="col-sm-3 col-xs-3 color3"></span>
            <span class="col-sm-3 col-xs-3 color2"></span>
            <span class="col-sm-3 col-xs-3 color4"></span>
        </div>
    </div>
    <!--   colors -->
    <div class="container-fluid">
        <div class="row">
            {{--<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDyOnCxk3saEx4Ep_KCENBLq9cpUWJ6znU&q=Cubabien+Travel" width="100%" height="300px;" frameborder="0" allowfullscreen></iframe>--}}
            {{--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3593.6813635258154!2d-80.3169097!3d25.7480488!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b85bf6cc7de1%3A0x4500a784417f60a7!2sCubabien+Travel!5e0!3m2!1ses!2sph!4v1536956331189"--}}
            {{--width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
            <div id="gmap" style="border:0; height: 400px; width: 100%"></div>
        </div>
    </div>

    <!-- section 9 -->
    <section class="section9">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12 left-image">
                    <img src="{{assets_frontend('images/travel_index.jpg')}}" class="img-responsive" alt="">
                </div>
                <div class="col-lg-7 col-sm-12">
                    <div class="title text-left">
                        <h2>{!! __('tour.section-header') !!}</h2>
                    </div>
                    <div class="row">
                        <div class="text-container">
                            <div class="col-sm-6">
                                <div class="text" data-aos="fade-up">
                                    <p>
                                        {!! __('tour.include-1') !!}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text" data-aos="fade-up">
                                    <p>
                                        {!! __('tour.include-2') !!}
                                    </p>
                                </div>
                            </div>
                            <div class="row2">
                                <div class="col-sm-6" data-aos="fade-up" data-aos-delay="100">
                                    <div class="text">
                                        <p>{!! __('tour.include-3') !!}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6" data-aos="fade-up" data-aos-delay="100">
                                    <div class="text">
                                        <p>{!! __('tour.include-4') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section 9 end -->

    <!-- box offer -->
    <section class="box-offer">
        <div class="container">
            {{--<div class="title padding">--}}
                {{--<h2>--}}
                    {{--<span class="red-color">This</span> is an Example of Box Container</h2>--}}
                {{--<p>Ex nisi amet commodo exercitation ea laborum tempor. Aute veniam sit nostrud voluptate culpa aute x--}}
                    {{--nisi amet commodo exercitation ea laborum tempor. Aute veniam sit nostrud voluptate culpa aute.</p>--}}
            {{--</div>--}}
            @foreach($tours as $tour)
                @if($loop->first || $loop->iteration % 3 === 0)
                    <div class="row">
                        @endif
                        <div class="col-sm-4">
                            <div class="box-container text-center" data-aos="fade-right">
                                <div class="box-title">
                                    <span class="price-top">${{$tour->getNearFecha()->precio_s_pax}} /1</span>
                                    <span class="price-top">${{$tour->getNearFecha()->precio_d_pax}} /2</span>
                                    {{--<i class="fa fa-lg fa-trophy"></i>--}}
                                    <h3>{{__($tour->nb_trad)}}</h3>
                                    {{--<p>Anim esse ut consequat et sit ullamco et.</p>--}}
                                </div>
                                <div class="box-body">
                                    <ul>
                                        <li>
                                            <span><i class="fa fa-tag fa-sm"></i></span>
                                            {{__('word.dep')}}: <b>{{__('dayweek.id'.$tour->salida_dia_trad)}}</b>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-tag fa-sm"></i></span>
                                            {{__('word.ret')}}: <b>{{__('dayweek.id'.$tour->llegada_dia_trad)}}</b>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-tag fa-sm"></i></span>
                                            {{__('word.up-to')}} <b>{{$tour->getNearCantFecha()}}</b> {{__('word.bidding')}}
                                        </li>
                                        <li>
                                            <span><i class="fa fa-tag fa-sm"></i></span>
                                            <b>{{$tour->num_dias}}</b> {{__('word.days')}}
                                        </li>
                                        <li>
                                            <span><i class="fa fa-tag fa-sm"></i></span>
                                            <b>{{$tour->num_noches}}</b> {{__('word.nights')}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="buttons">
                                    <a data-animation-in="zoomIn" href="{{route('travel_cuba.show',[$tour->id])}}"
                                       class="button btn btn-md btn-default btn-outline-dark delay4 radius25">{!! __('button.details') !!}</a>
                                    <br>
                                    <a data-animation-in="zoomIn" href="#"
                                       class="button btn btn-md btn-default btn-outline-dark delay4 radius25 cd-add-to-cart" data-price="{{$tour->getNearFecha()->precio_d_pax}}">{!! __('button.add-cart') !!}</a>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration % 3 === 0)
                    </div>
                    <div class="long-line"></div>
                @endif
            @endforeach
        </div>
    </section>
    <!-- box offer end -->

@endsection

@section('js')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3OX0imnBu0_B6HuBPAekTzVcxkwwYm-w&callback=initMap"></script>
    <script type="text/javascript">
        function initMap() {
            var locations = {!! json_encode($marcadores) !!};

            var map = new google.maps.Map(document.getElementById('gmap'), {
                zoom: 7,
                center: new google.maps.LatLng(21.504186, -79.683838),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][2]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    </script>

    <script type="text/javascript">

    </script>
@endsection
