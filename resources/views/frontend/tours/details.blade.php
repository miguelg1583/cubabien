@extends('frontend.layouts.master')

@section('title', __('menu.travel_cuba'))

@section('css')
@endsection

@section('content')
    <!-- header 1 -->
    <div class="header1 about-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="text-container text-left">
                        <h2>{{__($tour->nb_trad)}}</h2>
                        <p>{{strtoupper(__('word.dep')).': '.__('dayweek.id'.$tour->salida_dia_trad).' - '.strtoupper(__('word.ret')).': '.__('dayweek.id'.$tour->llegada_dia_trad)}}</p>
                        <p>{{$tour->num_dias}} {{__('word.days')}} - {{$tour->num_noches}} {{__('word.nights')}}</p>
                        {{--<div class="buttons">--}}
                            {{--<a href="#" class="button btn btn-md btn-outline-dark radius5" style="color: white">{!! __('button.add-cart') !!}</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header 1 end -->

    {{--<!-- entry text -->--}}
    {{--<section class="entry-about">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="text-container">--}}
                    {{--<div class="title padding">--}}
                        {{--<h2><span class="red-color">{!! __('word.summary') !!}</span></h2>--}}
                        {{--<div class="long-line"></div>--}}
                        {{--<p>{!! __($tour->introd_trad) !!}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--<!-- entry text end -->--}}



    <!-- text image -->
    <section class="text-image bg3">
        <div class="container">
            <div class="row">
                <div id="gmap" class="col-sm-6" style="height: 365px">
{{--                    <img src="{{assets_frontend('images/tabs.jpg')}}" class="img-responsive img-relative" alt="Poner Mapa Aqui">--}}
                </div>
                {{--<div class="col-sm-6" data-aos="fade-right">--}}
                    {{--<img src="{{assets_frontend('images/tabs.jpg')}}" class="img-responsive img-relative" alt="Poner Mapa Aqui">--}}
                {{--</div>--}}
                <div class="col-sm-6">
                    <div class="title text-left">
                        <h2>{!! __('tour.header-1') !!}</h2>
                    </div>
                    <div class="text-container">
                        <div class="text">
                            {{--<h4> Non est sint anim pariatur nulla qui. Et ut Lorem aliqua pariatur incididunt voluptate irure eu veniam mollit qui ex commodo ipsumo.</h4>--}}
                            <br>
                            <p>{!! __($tour->introd_trad) !!}</p>
                            <br>
                            <p><b>{!! __('word.price-s') !!}:</b> $ {{number_format((float)$tour->getNearFecha()->precio_s_pax, 2, '.', '')}}</p>
                            <p><b>{!! __('word.price-d') !!}:</b> $ {{number_format((float)$tour->getNearFecha()->precio_d_pax, 2, '.', '')}}</p>
                            {{--<div class="buttons">--}}
                                {{--<a href="#" class="button btn btn-md btn-default btn-outline-dark btn-margin-right"><span><i class="fa fa-shopping-cart fa-sm"></i>&nbsp;&nbsp; $ {{$tour->getNearFecha()->precio_s_pax}} / 1</span></a>--}}
                                {{--<a href="#" class="button btn btn-md btn-default btn-outline-dark radius5 btn-margin-right"><span><i class="fa fa-shopping-cart fa-sm"></i>&nbsp;&nbsp; $ {{$tour->getNearFecha()->precio_d_pax}} / 2</span></a>--}}
                            {{--</div>--}}
                            <div class="buttons">
                                <a href="#" class="button btn btn-md btn-default btn-outline-dark radius5 btn-margin-right cd-add-to-cart" data-price="{{$tour->getNearFecha()->precio_d_pax}}">{!! __('button.add-cart') !!}</a>
                                {{--<a href="#" class="button btn btn-md btn-default btn-red radius5 btn-margin-right">{!! __('button.add-cart') !!}</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  text image -->

    <!-- entry text -->
    <section class="entry-about">
        <div class="container">
            <div class="row">
                <div class="text-container">
                    <div class="title padding">
                        <h2><span class="red-color">{!! __('word.itinerary') !!}</span></h2>
                        <div class="long-line"></div>
                        {!! __('tour.final-notes') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- entry text end -->

    <!-- section start -->
    <section class="timeline">
        <div class="container">
            <div class="row">
                <ul class="timeline">
                    @foreach($tour->itinerario as $itine)
                        @if($loop->iteration % 2 === 1)
                            <li>
                        @else
                            <li class="timeline-inverted">
                        @endif
                                <div class="timeline-badge">{{$itine->dia}}</div>
                                <div class="timeline-panel" data-aos="fade-up">
                                    {{--<div class="timeline-heading">--}}
                                        {{--<h4 class="timeline-title">{!! __('about_us.time-h-1') !!}</h4>--}}
                                    {{--</div>--}}
                                    <div class="timeline-body">
                                        <p>{!! __($itine->contenido_trad) !!}</p>
                                    </div>
                                </div>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- end of section -->

    <!-- table -->
    <div class="table-pricing">
        <div class="container">
            <div class="row">
                <div class="modern-title">
                    <div class="col-sm-6">
                        {{--<div class="text-right">--}}
                            <h2>{!! __('tour.header-2') !!}</h2>
                        {{--</div>--}}
                    </div>
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="text-left">--}}
                            {{--<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model--}}
                                {{--text--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="table-responsive" style="overflow-y: hidden">
                    {{--<table class="table table-striped custab">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>{{__('word.dep')}}</th>--}}
                            {{--<th>{{__('word.ret')}}</th>--}}
                            {{--<th>{!! __('word.price-s') !!}</th>--}}
                            {{--<th>{!! __('word.price-d') !!}</th>--}}
                            {{--<th> </th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--@foreach($tour->getAllFechaAfterToday() as $fecha)--}}
                            {{--<tr>--}}
                                {{--<td>{{$fecha->desde}}</td>--}}
                                {{--<td>{{$fecha->hasta}}</td>--}}
                                {{--<td>{{$fecha->precio_s_pax}}</td>--}}
                                {{--<td>{{$fecha->precio_d_pax}}</td>--}}
                                {{--<td><button class="btn button btn-red radius5 btn-sm">{!! __('button.add-cart') !!}</button></td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--<!-- part 2 ends here -->--}}
                    {{--</table>--}}
                    <table id="DT_fechas" class="table table-striped custab dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>{{__('word.dep')}}</th>
                            <th>{{__('word.ret')}}</th>
                            <th>{!! __('word.price-s') !!}</th>
                            <th>{!! __('word.price-d') !!}</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- table end-->

@endsection

@section('js')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3OX0imnBu0_B6HuBPAekTzVcxkwwYm-w&callback=initMap"></script>
    <script type="text/javascript">
        $(document).ready(()=>{
            App.init("{{config('app.url')}}");
            App.initAjaxFront();
            // App.initDatatable();
            $('#DT_fechas').DataTable({
                'paging': true,
                'lengthMenu': [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                'responsive': true,
                language: {
                    "decimal":        "",
                    "emptyTable":     "{{__('datatable.emptyTable')}}",
                    "info":           "{{__('datatable.info')}}",
                    "infoEmpty":      "{{__('datatable.infoEmpty')}}",
                    "infoFiltered":   "{{__('datatable.infoFiltered')}}",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "{{__('datatable.lengthMenu')}}",
                    "loadingRecords": "{{__('datatable.loadingRecords')}}",
                    "processing":     "{{__('datatable.processing')}}",
                    "search":         "{{__('datatable.search')}}",
                    "zeroRecords":    "{{__('datatable.zeroRecords')}}",
                    "paginate": {
                        "first":      "{{__('datatable.first')}}",
                        "last":       "{{__('datatable.last')}}",
                        "next":       "{{__('datatable.next')}}",
                        "previous":   "{{__('datatable.previous')}}"
                    },
                    "aria": {
                        "sortAscending":  "{{__('datatable.sortAscending')}}",
                        "sortDescending": "{{__('datatable.sortDescending')}}"
                    }
                },
                searchDelay: 800,
                serverSide: true,
                // order: [[5, 'asc']],
                ajax: {
                    url: "{!! route('fechasAfter.list') !!}",
                    type: "POST",
                    data: {"tour": '{{$tour->id}}'}
                },

                columns: [
                    {data: 'desde'},
                    {data: 'hasta'},
                    {data: 'precio_s_pax'},
                    {data: 'precio_d_pax'},
                    {data: 'operaciones'}
                ],
            });
        });

        function initMap() {
            // let mapOptions = {
            //     center: new google.maps.LatLng(21.504186, -79.683838),
            //     zoom: 7,
            //     mapTypeId: google.maps.MapTypeId.ROADMAP
            // };
            // let map = new google.maps.Map(document.getElementById("gmap"), mapOptions);
            var locations = {!! json_encode($marcadores) !!};

            console.log(locations);

            var map = new google.maps.Map(document.getElementById('gmap'), {
                zoom: 6,
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
@endsection
