@extends('backend.layouts.master')

@section('title', 'Mapa de Tour - Crear Punto')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/leaflet/leaflet.css')}}"/>
@endsection

@section('title_content', 'Mapa de Tour')

@section('content')
    <div id="app" v-cloak>
        @include('backend.traducciones.partial.cu_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-file-code-o"></i> Agregar
                    <small>inserte las traducciones desde el boton en cada campo</small>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('mapa.tour')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tour">Tour <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="tour" class="form-control col-md-7 col-xs-12"
                                    name="tour"
                                    data-vv-scope="mapa"
                                    v-model="mapa.tour_id"
                                    v-validate="'required'">
                                <option disabled value="">Seleccione un Tour</option>
                                <option v-for="(val, index) in tours" :value="val.id">@{{ val.text }}</option>
                            </select>
                            <span class="help-block">@{{ errors.first('mapa.tour') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('mapa.latitud')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitud">Latitud
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="latitud" class="form-control col-md-7 col-xs-12"
                                   name="latitud"
                                   type="text"
                                   data-vv-scope="mapa"
                                   v-model="mapa.latitud"
                                   v-validate="'required|between:-90.999999,90.999999'">
                            <span class="help-block">@{{ errors.first('mapa.latitud') }}</span>
                        </div>
                    </div>

                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('mapa.longitud')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longitud">Longitud
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="longitud" class="form-control col-md-7 col-xs-12"
                                   name="longitud"
                                   type="text"
                                   data-vv-scope="mapa"
                                   v-model="mapa.longitud"
                                   v-validate="'required|between:-180.999999,180.999999'">
                            <span class="help-block">@{{ errors.first('mapa.longitud') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('mapa.etiqueta')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="etiqueta">Etiqueta <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group">
                                <input id="etiqueta" class="form-control col-md-4 col-xs-12"
                                       name="etiqueta"
                                       type="text"
                                       v-model="mapa.etiqueta.valor"
                                       data-vv-scope="mapa"
                                       v-validate="'required|min:2|max:190'">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Etiqueta')"
                                            :disabled="valorNoLLeno(mapa.etiqueta.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                        </span>
                            </div>
                            <span class="help-block">@{{ errors.first('mapa.etiqueta') }}</span>

                        </div>
                        <button class="btn btn-round btn-success"
                                v-on:click.prevent="actionAddElement('mapa')"
                                :disabled="addNoValido('mapa')">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>

                </form>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-2">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Tour</th>
                                <th>Latitud</th>
                                <th>Logitud</th>
                                <th>Etiqueta</th>
                                <th>Operación</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(coord, pos_coord) in mapa_tour">
                                <td>@{{ encuentraTourNombre(coord.tour_id) }}</td>
                                <td>@{{ coord.latitud }}</td>
                                <td>@{{ coord.longitud }}</td>
                                <td>@{{ coord.etiqueta.valor }}</td>
                                <td><a href="javascript:;" class="label label-danger"
                                       v-on:click.prevent="quitaDeArreglo('mapa_tour', pos_coord)"><span
                                                class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div id="mapOpenStreet">
                        {{--<div id="myMap" style="border:0; height: 400px; width: 100%"></div>--}}
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary" :disabled="isNoValido"
                                v-on:click.prevent="createLista()"><span
                                    class='fa fa-list'></span>Guardar y Regresar al listado
                        </button>
                        <button id="send" type="submit" class="btn btn-success" :disabled="isNoValido"
                                v-on:click.prevent="createAgrega()"><span
                                    class='fa fa-check'></span>Guardar y Agregar otro
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{assets_file('vendor/leaflet/leaflet.js')}}"></script>
    <script type="text/javascript">
        Vue.use(VeeValidate, {locale: 'es'});
        window.vmContext = new Vue({
            el: "#app",
            beforeCreate() {
                App.init("{{config('app.url')}}");
                // App.initVue();
            },
            created() {
                this.setInicial();
                this.setInicialTrad();
                App.initAjax();
            },
            mounted() {
                this.dibujaMapa();
            },
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                tours: {!! json_encode($tours) !!},
                campo_trad: "",

                mapa_tour: [],
                mapa: {
                    tour_id: "",
                    latitud: "",
                    longitud: "",
                    etiqueta: {
                        valor: "",
                        @include('backend.traducciones.partial.vdata_trad')
                    }
                },
                // include----------------------------
                @include('backend.traducciones.partial.vdata_trad')
                //cierra include----------------------------
            },
            computed: {
                isNoValido() {
                    return this.mapa_tour.length === 0;
                },
            },
            methods: {
                valorNoLLeno: function (campo) {
                    return campo === ""
                },
                setInicial: function () {
                    self = this;
                    this.campo_trad = "";
                    this.mapa_tour = [];
                    this.mapa = {
                        tour_id: "",
                        latitud: "",
                        longitud: "",
                        etiqueta: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        }
                    };
                    this.idiomas.forEach(function (item) {
                        self.mapa.etiqueta.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                    });
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset().then(() => {
                                this.errors.clear()
                            });
                            // this.errors.clear();
                        });
                },
                //include --------------------------------------
                @include('backend.traducciones.partial.vmethod_trad')
                //cierra  include --------------------------------------
                actionAddElement: function (elemento) {
                    switch (elemento) {
                        case "mapa":
                            this.$validator.validate('mapa.*').then(function (elem) {
                                if (elem) {
                                    vmContext.mapa_tour.push(vmContext.mapa);
                                    vmContext.setInicialMapa();
                                    vmContext.dibujaMapa();
                                }
                            });
                            // this.mapa_tour.push(this.mapa);
                            // vmContext.setInicialMapa();
                            break;
                    }
                },
                setInicialMapa: function () {
                    this.mapa = {
                        latitud: "",
                        longitud: "",
                        etiqueta: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        }
                    }
                },
                dibujaMapa: function () {
                    $('#mapOpenStreet').html('<div id="myMap" style="border:0; height: 400px; width: 100%"></div>');
                    let map = L.map('myMap').setView([21.504186, -79.683838], 7);
                    // let map = L.map('myMap').setView([23.08478515994374, -82.38510131835939], 7);

                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWlndWVsZzE5MDMiLCJhIjoiY2ptYWxnZjVhMDE5aTN3bzBkeXo3OTdtYiJ9.Rmrk4CQTDjsXIdSj_79G4g', {
                        maxZoom: 18,
                        attribution: 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                        id: 'mapbox.streets'
                    }).addTo(map);


                    if (this.mapa_tour.length > 0) {
                        let arrMarker = [];

                        this.mapa_tour.forEach(function (item_mapa) {
                            arrMarker.push(L.marker([Number(item_mapa.latitud), Number(item_mapa.longitud)]).bindPopup(item_mapa.etiqueta.valor).openPopup());
                            // L.marker([Number(item_mapa.latitud), Number(item_mapa.longitud)]).addTo(map)
                            //     .bindPopup(item_mapa.etiqueta.valor).openPopup();
                        });

                        L.layerGroup(arrMarker).addTo(map);
                    }

                    let popup = L.popup();

                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent("Click en: " + e.latlng.toString())
                            .openOn(map);
                        // console.log(e.latlng);
                        vmContext.mapa.latitud = e.latlng.lat;
                        vmContext.mapa.longitud = e.latlng.lng;
                        // console.log(e.latlng.lat);
                        // console.log(e.latlng.lng);
                    }

                    map.on('click', onMapClick);
                },
                addNoValido: function (step) {
                    let self = this;
                    switch (step) {
                        case "mapa":
                            return !!(this.errors.has('mapa.*'));
                            break;
                    }
                },
                quitaDeArreglo: function (arreglo, posicion) {
                    // console.log('empezando');
                    vmContext[arreglo].splice(posicion, 1);
                    if (arreglo === "mapa_tour") {
                        this.dibujaMapa()
                    }
                    // console.log('pasado');
                },
                encuentraTourNombre: function (id_tour) {
                    return this.tours.find(function (tour) {
                        return tour.id === id_tour;
                    }).text;
                },
                createLista: function () {
                    // this.$validator.validateAll('mapa').then(function (result) {
                        if (vmContext.mapa_tour.length>0) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('mapa-tour.store') !!}',
                                data: {
                                    'mapa_tour': vmContext.mapa_tour,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Mapa creado satisfactoriamente');
                                    window.location.replace(App.getBaseUrl() + '/admin/mapa-tour');
                                }
                            });

                        }
                    // });
                },
                createAgrega: function () {
                    // this.$validator.validateAll('mapa').then(function (result) {
                        if (vmContext.mapa_tour.length>0) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('mapa-tour.store') !!}',
                                data: {
                                    'mapa_tour': vmContext.mapa_tour,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Mapa creado satisfactoriamente');
                                    vmContext.setInicial();
                                    vmContext.setInicialTrad();
                                }
                            });

                        }
                    // });
                },
                actionModal: function () {
                    this.$validator.validateAll('modal_trad').then((result) => {
                        if (result) {
                            switch (vmContext.campo_trad) {
                                case "Etiqueta":
                                    vmContext.mapa.etiqueta.traduccion = vmContext.traduccion;
                                    vmContext.setInicialTrad();
                                    $("#tradModal").modal("hide");
                                    break;
                            }
                        }
                    });
                },
            }
        });
    </script>
@endsection
