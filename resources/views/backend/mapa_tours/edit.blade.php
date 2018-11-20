@extends('backend.layouts.master')

@section('title', 'Mapas - Editar')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/leaflet/leaflet.css')}}"/>
@endsection

@section('title_content', 'Mapas de los Tours')

@section('content')
    <div id="app" v-cloak>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-file-code-o"></i> Editar
                    <small>si desea cambiar las traducciones vaya al apartado traducciones</small>
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
                            <input id="etiqueta" class="form-control col-md-7 col-xs-12"
                                   name="etiqueta"
                                   type="text"
                                   v-model="mapa.etiqueta"
                                   data-vv-scope="mapa"
                                   v-validate="'required|min:2|max:190'">
                            <span class="help-block">@{{ errors.first('mapa.etiqueta') }}</span>
                        </div>
                        <button class="btn btn-round btn-success"
                                v-on:click.prevent="dibujaMapa()"
                                :disabled="addNoValido('mapa')">
                            <span class="glyphicon glyphicon-check"></span>
                        </button>
                    </div>

                </form>
                <div class="clearfix"></div>
                <div class="row">
                    <div id="mapOpenStreet">
                        {{--<div id="myMap" style="border:0; height: 400px; width: 100%"></div>--}}
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary" :disabled="isNoValido"
                                v-on:click.prevent="updateLista()"><span
                                    class='fa fa-list'></span>Guardar y Regresar al listado
                        </button>
                        <button id="send" type="submit" class="btn btn-success" :disabled="isNoValido"
                                v-on:click.prevent="updateEdita()"><span
                                    class='fa fa-check'></span>Guardar
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
                App.initAjax();
            },
            mounted() {
                this.dibujaMapa();
            },
            data: {
                tours: {!! json_encode($tours) !!},
                mapa: {!! json_encode($mapa) !!},
            },
            computed: {
                isNoValido() {
                    let self = this;
                    if (self.errors.any('$mapa')) {
                        return true;
                    } else {
                        if (this.fields['$mapa']) {
                            Object.keys(this.fields['$mapa']).forEach(function (item) {
                                if (item.validated === false) {
                                    return true;
                                }
                            });
                        }
                    }
                    return false;
                },

            },
            methods: {
                valorNoLLeno: function (campo) {
                    return campo === ""
                },
                dibujaMapa: function () {
                    let self = this;
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

                    let item_mapa = self.mapa;
                    let arrMarker = [L.marker([Number(item_mapa.latitud), Number(item_mapa.longitud)]).bindPopup(item_mapa.etiqueta).openPopup()];

                    L.layerGroup(arrMarker).addTo(map);


                    let popup = L.popup();

                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent("Click en: " + e.latlng.toString())
                            .openOn(map);
                        // console.log(e.latlng);
                        self.mapa.latitud = e.latlng.lat;
                        self.mapa.longitud = e.latlng.lng;
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
                updateLista: function () {
                    $.ajax({
                        type: 'PUT',
                        url: '{!! url('/admin/mapa-tour') !!}/' + vmContext.mapa.id,
                        data: {
                            'mapa': vmContext.mapa,
                        }
                    }).done(function (data) {
                        if (data.errors) {
                            console.log(data);
                            App.showNotiError('Ha ocurrido un problema en el servidor');
                        } else {
                            App.showNotiSuccess('Mapa modificado satisfactoriamente');
                            window.location.replace(App.getBaseUrl() + '/admin/mapa-tour');
                        }
                    });

                },
                updateEdita: function () {

                    $.ajax({
                        type: 'PUT',
                        url: '{!! url('/admin/mapa-tour') !!}/' + vmContext.mapa.id,
                        data: {
                            'mapa': vmContext.mapa,
                        }
                    }).done(function (data) {
                        if (data.errors) {
                            console.log(data);
                            App.showNotiError('Ha ocurrido un problema en el servidor');
                        } else {
                            App.showNotiSuccess('Mapa creado satisfactoriamente');
                        }
                    });
                },
            }
        });
    </script>
@endsection
