@extends('backend.layouts.master')

@section('title', 'Mapas')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/leaflet/leaflet.css')}}"/>
@endsection

@section('title_content', 'Mapas de los Tours')

@section('content')
    @include('backend.layouts.delete_modal')
    @include('backend.layouts.show_modal')
    <a href="{{route('mapa-tour.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>

    <div id="app" v-cloak>
        <div class="x_panel" v-for="(tour, posTour) in tours">
            <div class="x_title">
                <h2>@{{tour.nb}}
                    <small>@{{tour.mapa.length}} lugares geo-referenciados</small>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="dashboard-widget-content">
                    <div class="col-md-6 table-responsive">
                        <h2><i class="fa fa-bars"></i> Puntos</h2>
                        <table class="table table-striped" :id="'DT'+posTour">
                            <thead>
                            <tr>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Etiqueta</th>
                                <th>Traducción</th>
                                <th>Operaciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(map, pos) in tour.mapa">
                                <td>@{{reduceString(map.latitud, 11)}}</td>
                                <td>@{{reduceString(map.longitud, 11)}}</td>
                                <td>@{{map.etiqueta}}</td>
                                <td>
                                    <a v-on:click.stop.prevent="showTradu(map.etiqueta_trad)" class="show_modal_table">@{{map.etiqueta_trad}}</a>
                                </td>
                                <td><a :href="'{!! url('/admin/mapa-tour') !!}/'+map.id+'/edit'"
                                       class="btn btn-round btn-info" :data-id="map.id">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <button class="btn btn-round btn-danger delete-modal"
                                            data-toggle="modal" data-target="#deleteModal" :data-id="map.id"
                                            :data-index="pos" :data-tour-index="posTour">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div :id="'mapa_tour'+tour.id" class="col-md-6 col-sm-12 col-xs-12"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{assets_file('vendor/leaflet/leaflet.js')}}"></script>
    <script type="text/javascript">
        window.vmContext = new Vue({
            el: "#app",
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                tours: {!! json_encode($tours) !!},
            },
            methods: {
                getMomentFormat: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').format("dddd, DD/MM/YYYY h:mm a");
                },
                capitalize: function (s) {
                    if (typeof s !== 'string') return '';
                    return s.charAt(0).toUpperCase() + s.slice(1)
                },
                showTradu: function (trad_string) {
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('getTrad') !!}',
                        data: {
                            'trad': trad_string,
                        },
                        success: function (data) {
                            if (data.errors) {
                                console.log(data);
                                App.showNotiError('Ha ocurrido un problema en el servidor');
                            } else {
                                $("#show_modal_content").html(data);
                                $("#showModal").modal("show");
                            }
                        },
                    });

                },
                reduceString: function (datoString, ancho) {
                    if (datoString.length < ancho) {
                        return datoString
                    } else {
                        return datoString.substring(0, ancho) + '...';
                    }
                },
                cargaMapaAll: function () {
                    this.tours.forEach(function (elem) {
                        $('#mapa_tour' + elem.id).html('<div id="' + "myMap" + elem.id + '" style="border:0; height: 400px; width: 100%"></div>');
                        let map = L.map('myMap' + elem.id).setView([21.504186, -79.683838], 6);

                        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWlndWVsZzE5MDMiLCJhIjoiY2ptYWxnZjVhMDE5aTN3bzBkeXo3OTdtYiJ9.Rmrk4CQTDjsXIdSj_79G4g', {
                            maxZoom: 18,
                            attribution: 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                            'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                            id: 'mapbox.streets'
                        }).addTo(map);


                        if (elem.mapa.length > 0) {
                            let arrMarker = [];

                            elem.mapa.forEach(function (item_mapa) {
                                arrMarker.push(L.marker([Number(item_mapa.latitud), Number(item_mapa.longitud)]).bindPopup(item_mapa.etiqueta).openPopup());
                            });

                            L.layerGroup(arrMarker).addTo(map);
                        }
                    })
                },
                cargaMapa: function (tour_index) {
                    $('#mapa_tour' + vmContext.tours[tour_index].id).html('<div id="' + "myMap" + vmContext.tours[tour_index].id + '" style="border:0; height: 400px; width: 100%"></div>');
                    let map = L.map('myMap' + vmContext.tours[tour_index].id).setView([21.504186, -79.683838], 6);

                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWlndWVsZzE5MDMiLCJhIjoiY2ptYWxnZjVhMDE5aTN3bzBkeXo3OTdtYiJ9.Rmrk4CQTDjsXIdSj_79G4g', {
                        maxZoom: 18,
                        attribution: 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                        id: 'mapbox.streets'
                    }).addTo(map);


                    if (vmContext.tours[tour_index].mapa.length > 0) {
                        let arrMarker = [];

                        vmContext.tours[tour_index].mapa.forEach(function (item_mapa) {
                            arrMarker.push(L.marker([Number(item_mapa.latitud), Number(item_mapa.longitud)]).bindPopup(item_mapa.etiqueta).openPopup());
                        });

                        L.layerGroup(arrMarker).addTo(map);
                    }
                }
            },
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initAjax();
            },
            mounted: function () {
                this.cargaMapaAll();
                App.initDatatable();
            },

        });

        //delete
        let id = '';
        let indexMapa = '';
        let indexTour = '';
        $(document).on("click", ".delete-modal", function () {
            id = $(this).data("id");
            indexMapa = $(this).data("index");
            indexTour = $(this).data("tour-index");
        });
        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/mapa-tour') !!}').done(function () {
                vmContext.tours[indexTour].mapa.splice(indexMapa, 1);
                vmContext.cargaMapa(indexTour);
            });
        });
    </script>
@endsection
