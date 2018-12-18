@extends('backend.layouts.master')

@section('title', 'Itinerario - Editar')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/select2/css/select2.min.css')}}"/>
@endsection

@section('title_content', 'Itinerario de Tour')

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
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('itinerario.tour')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tour">Tour <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="tour" class="form-control col-md-7 col-xs-12"
                                    name="tour"
                                    data-vv-scope="itinerario"
                                    v-model="itinerario.tour_id"
                                    v-validate="'required'" disabled>
                                <option disabled value="">Seleccione un Tour</option>
                                <option v-for="(val, index) in tours" :value="val.id">@{{ val.nb }}</option>
                            </select>
                            <span class="help-block">@{{ errors.first('itinerario.tour') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('itinerario.dia')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dia
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="dia" class="form-control col-md-7 col-xs-12"
                                   name="dia"
                                   type="number"
                                   data-vv-scope="itinerario"
                                   v-model="itinerario.dia"
                                   v-validate="'required|integer|min_value:1'">
                            <span class="help-block">@{{ errors.first('itinerario.dia') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('itinerario.contenido')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contenido">Contenido
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <fe-summernote id="contenido" class="form-control"
                                           name="contenido"
                                           type="text" v-model="itinerario.contenido"
                                           data-vv-scope="itinerario"
                                           v-validate="'required|min:5'"></fe-summernote>
                        </div>

                        <span class="help-block">@{{ errors.first('itinerario.contenido') }}</span>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('itinerario.imagen')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tour">Imagen </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select2 id="imagen" class="form-control col-md-7 col-xs-12"
                                     name="imagen"
                                     v-model="itinerario.imagen"
                                     :options="imagenes"
                                     :allowclear="true">
                                {{--<option disabled value="">Seleccione una Imagen</option>
                                <option v-for="(img) in imagenes" :value="img">@{{ img }}</option>--}}
                            </select2>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-sm-offset-4 col-md-offset-4">
                        <img :src="imagen_encode" class="img-responsive" :alt="itinerario.imagen">
                    </div>
                </form>
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
    <script src="{{assets_file('vendor/select2/js/select2.full.min.js')}}"></script>
    {{--<script src="{{assets_file('backend/js/vue-select2.js')}}"></script>--}}
    <script type="text/javascript">
        Vue.use(VeeValidate, {locale: 'es'});
        // Vue.use(Select2);
        // Vue.component('Select2',Select2);
        window.vmContext = new Vue({
            el: "#app",
            // components: {Select2},
            beforeCreate() {
                App.init("{{config('app.url')}}");
                // App.initVue();
            },
            created() {
                App.initAjax();
            },
            data: {
                tours: {!! json_encode($tours) !!},
                imagenes: {!! json_encode($imagenes) !!},
                itinerario: {!! json_encode($itinerario) !!},
                imagen_encode: '{!! $imagen_encode !!}'
            },
            watch: {
                'itinerario.imagen': function (despues, antes) {
                    let self = this;
                    if (despues === '') {
                        self.imagen_encode = '';
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '{!! route('imagen.encode') !!}',
                            data: {
                                'imagen': despues,
                                'width': 300,
                                'height': 200,
                            }
                        }).done(function (data) {
                            if (data.errors) {
                                console.log(data);
                                App.showNotiError('Ha ocurrido un problema en el servidor');
                            } else {
                                self.imagen_encode = data.mensaje;
                            }
                        })
                    }

                }
            },
            computed: {
                isNoValido() {
                    let self = this;
                    if (self.errors.has('itinerario.*')) {
                        return true;
                    } else {
                        if (self.fields['$itinerario']) {
                            Object.keys(self.fields['$itinerario']).forEach(function (item) {
                                if (item.validated === false || item.touched === false) {
                                    return true;
                                }
                            });
                        }
                    }
                }
            },
            methods: {
                valorNoLLeno: function (campo) {
                    return campo === ""
                },
                updateLista: function () {
                    this.$validator.validate('itinerario.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/itinerario-tour') !!}/' + vmContext.itinerario.id,
                                data: {
                                    'itinerario_tour': vmContext.itinerario,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Itinerario modificado satisfactoriamente');
                                    window.location.replace(App.getBaseUrl() + '/admin/itinerario-tour');
                                }
                            });

                        }
                    });
                },
                updateEdita: function () {
                    this.$validator.validate('itinerario.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/itinerario-tour') !!}/' + vmContext.itinerario.id,
                                data: {
                                    'itinerario_tour': vmContext.itinerario,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Itinerario modificado satisfactoriamente');
                                }
                            });

                        }
                    });
                }
            }
        });
    </script>
@endsection
