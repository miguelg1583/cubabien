@extends('backend.layouts.master')

@section('title', 'Preguntas y Respuestas - Crear')

@section('css')
@endsection

@section('title_content', 'Preguntas y Respuestas')

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
                <form class="form-horizontal form-label-left" novalidate autocomplete="off">
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('pregunta_resp.categoria')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoria">Categoria <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="categoria" class="form-control col-md-7 col-xs-12"
                                    name="categoria"
                                    data-vv-scope="pregunta_resp"
                                    v-model="pregunta_resp.categoria_faq_id"
                                    v-validate="'required'">
                                <option disabled value="">Seleccione una Categoria</option>
                                <option v-for="(val, index) in categorias" :value="val.id">@{{ val.text }}</option>
                            </select>
                            <span class="help-block">@{{ errors.first('pregunta_resp.categoria') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('pregunta_resp.pregunta')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pregunta">Pregunta <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group">
                                <input id="pregunta" class="form-control col-md-4 col-xs-12"
                                       name="pregunta"
                                       type="text" v-model="pregunta_resp.pregunta.valor"
                                       data-vv-scope="pregunta_resp"
                                       v-validate="'required|min:5|max:190'">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Pregunta')"
                                            :disabled="valorNoLLeno(pregunta_resp.pregunta.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                </span>
                            </div>
                            <span class="help-block">@{{ errors.first('pregunta_resp.pregunta') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('pregunta_resp.respuesta')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="respuesta">Respuesta <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group">
                                <fe-summernote id="respuesta" class="form-control col-md-4 col-xs-12"
                                               name="respuesta"
                                               type="text" v-model="pregunta_resp.respuesta.valor"
                                               data-vv-scope="pregunta_resp"
                                               v-validate="'required|min:5'"></fe-summernote>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Respuesta')"
                                            :disabled="valorNoLLeno(pregunta_resp.respuesta.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                </span>
                            </div>
                            <span class="help-block">@{{ errors.first('pregunta_resp.respuesta') }}</span>
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
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        Vue.use(VeeValidate, {locale: 'es'});
        window.vmContext = new Vue({
            el: "#app",
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initVue();
            },
            created() {
                this.setInicial();
                this.setInicialTrad();
                App.initAjax();
            },
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                categorias: {!! json_encode($categorias) !!},
                campo_trad: "",
                pregunta_resp: {
                    categoria_faq_id: "",
                    pregunta: {
                        valor: "",
                        @include('backend.traducciones.partial.vdata_trad')
                    },
                    respuesta: {
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
                    // return Object.keys(this.fields).some(key => key!=='$modal_trad' && this.fields[key].validated === false) || this.errors.any();
                    let self = this;
                    if (self.errors.any('$pregunta_resp')) {
                        return true;
                    } else {
                        if (this.fields['$pregunta_resp']) {
                            Object.keys(this.fields['$pregunta_resp']).forEach(function (item) {
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
                setInicial: function () {
                    self = this;
                    this.campo_trad = "";
                    this.pregunta_resp.categoria_faq_id = "";
                    this.pregunta_resp.pregunta = {
                        valor: "",
                        traduccion: {
                            // group: "",
                            // key: "",
                            text: []
                        }
                    };
                    this.pregunta_resp.respuesta = {
                        valor: "",
                        traduccion: {
                            // group: "",
                            // key: "",
                            text: []
                        }
                    };
                    this.idiomas.forEach(function (item) {
                        self.pregunta_resp.pregunta.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                        self.pregunta_resp.respuesta.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                    });
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset('pregunta_resp');
                            this.errors.clear();
                        });
                },
                //include --------------------------------------
                @include('backend.traducciones.partial.vmethod_trad')
                //cierra  include --------------------------------------
                createLista: function () {
                    this.$validator.validateAll('pregunta_resp').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('pregunta-resp.store') !!}',
                                data: {
                                    'pregunta_resp': vmContext.pregunta_resp,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Pregunta con Respuesta creada satisfactoriamente');
                                        window.location.replace(App.getBaseUrl() + '/admin/pregunta-resp');
                                    }
                                },
                            });

                        }
                    });
                },
                createAgrega: function () {
                    this.$validator.validateAll('pregunta_resp').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('pregunta-resp.store') !!}',
                                data: {
                                    'pregunta_resp': vmContext.pregunta_resp,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Pregunta con Respuesta creada satisfactoriamente');
                                        vmContext.setInicial();
                                        vmContext.setInicialTrad();
                                    }
                                },
                            });

                        }
                    });
                },
                actionModal: function () {
                    this.$validator.validateAll('modal_trad').then((result) => {
                        if (result) {
                            switch (vmContext.campo_trad) {
                                case "Pregunta":
                                    vmContext.pregunta_resp.pregunta.traduccion = vmContext.traduccion;
                                    vmContext.setInicialTrad();
                                    $("#tradModal").modal("hide");
                                    break;
                                case "Respuesta":
                                    vmContext.pregunta_resp.respuesta.traduccion = vmContext.traduccion;
                                    vmContext.setInicialTrad();
                                    $("#tradModal").modal("hide");
                                    break;
                                // default:
                                //     vmContext.setInicialTrad();
                                //     console.log('se hizo');
                                //     $("#tradModal").modal("hide");
                                //     break;
                            }
                        }

                    });
                },
            }
        });
    </script>
@endsection
