@extends('backend.layouts.master')

@section('title', 'Itinerario - Crear')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/select2/css/select2.min.css')}}"/>
@endsection

@section('title_content', 'Itinerario de Tour')

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
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('itinerario.tour')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tour">Tour <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="tour" class="form-control col-md-7 col-xs-12"
                                    name="tour"
                                    data-vv-scope="itinerario"
                                    v-model="itinerario.tour_id"
                                    v-validate="'required'">
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
                            <div class="input-group">
                                <fe-summernote id="contenido" class="form-control col-md-4 col-xs-12"
                                               name="contenido"
                                               type="text" v-model="itinerario.contenido.valor"
                                               data-vv-scope="itinerario"
                                               v-validate="'required|min:5'"></fe-summernote>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Contenido')"
                                            :disabled="valorNoLLeno(itinerario.contenido.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                </span>
                            </div>
                            <span class="help-block">@{{ errors.first('itinerario.contenido') }}</span>
                        </div>

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
                        <img :src="imagen_encode" class="img-responsive" alt="itinerario.imagen">
                    </div>
                </form>
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
    <script src="{{assets_file('vendor/select2/js/select2.full.min.js')}}"></script>
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
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                tours: {!! json_encode($tours) !!},
                imagenes: {!! json_encode($imagenes) !!},
                campo_trad: "",
                itinerario: {
                    tour_id: "",
                    dia: "",
                    contenido: {
                        valor: "",
                        @include('backend.traducciones.partial.vdata_trad')
                    },
                    imagen: ""
                },
                imagen_encode: '',
                // include----------------------------
                @include('backend.traducciones.partial.vdata_trad')
                //cierra include----------------------------
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
                },
            },
            methods: {
                valorNoLLeno: function (campo) {
                    return campo === ""
                },
                setInicial: function () {
                    self = this;
                    this.campo_trad = "";
                    this.itinerario = {
                        tour_id: "",
                        dia: "",
                        contenido: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        },
                        imagen: ""
                    };
                    this.idiomas.forEach(function (item) {
                        self.itinerario.contenido.traduccion.text.push({
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

                createLista: function () {
                    this.$validator.validate('itinerario.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('itinerario-tour.store') !!}',
                                data: {
                                    'itinerario_tour': vmContext.itinerario,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Itinerario creado satisfactoriamente');
                                    window.location.replace(App.getBaseUrl() + '/admin/itinerario-tour');
                                }
                            });

                        }
                    });
                },
                createAgrega: function () {
                    this.$validator.validate('itinerario.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('itinerario-tour.store') !!}',
                                data: {
                                    'itinerario_tour': vmContext.itinerario,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Itinerario creado satisfactoriamente');
                                    vmContext.setInicial();
                                    vmContext.setInicialTrad();
                                }
                            });

                        }
                    });
                },
                actionModal: function () {
                    this.$validator.validateAll('modal_trad').then((result) => {
                        if (result) {
                            switch (vmContext.campo_trad) {
                                case "Contenido":
                                    vmContext.itinerario.contenido.traduccion = vmContext.traduccion;
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
