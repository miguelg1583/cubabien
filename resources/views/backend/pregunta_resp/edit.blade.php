@extends('backend.layouts.master')

@section('title', 'Preguntas y Respuestas - Editar')

@section('css')
@endsection

@section('title_content', 'Preguntas y Respuestas')

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
                            <input id="pregunta" class="form-control col-md-7 col-xs-12"
                                   name="pregunta"
                                   type="text" v-model="pregunta_resp.pregunta"
                                   data-vv-scope="pregunta_resp"
                                   v-validate="'required|max:190'">
                            <span class="help-block">@{{ errors.first('pregunta_resp.pregunta') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('pregunta_resp.respuesta')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="respuesta">Respuesta <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <fe-summernote id="respuesta" class="form-control col-md-7 col-xs-12"
                                           name="respuesta"
                                           type="text" v-model="pregunta_resp.respuesta"
                                           data-vv-scope="pregunta_resp"
                                           v-validate="'required'"></fe-summernote>
                            <span class="help-block">@{{ errors.first('pregunta_resp.respuesta') }}</span>
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
                App.initAjax();
                this.setInicial();
            },
            data: {
                categorias: {!! json_encode($categorias) !!},
                pregunta_resp: {!! json_encode($pregunta_resp) !!},
            },
            computed: {
                isNoValido() {
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
                setInicial: function () {
                    self = this;
                    this.pregunta_resp = {!! json_encode($pregunta_resp) !!};
                    this.categorias = {!! json_encode($categorias) !!};
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset('pregunta_resp');
                            this.errors.clear();
                        });
                },
                updateLista: function () {
                    this.$validator.validateAll().then(function () {
                        if (!vmContext.errors.any()) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/pregunta-resp') !!}/' + vmContext.pregunta_resp.id,
                                data: {
                                    'pregunta_resp': vmContext.pregunta_resp,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Pregunta y Respuesta modificada satisfactoriamente');
                                        window.location.replace(App.getBaseUrl() + '/admin/pregunta-resp');
                                    }
                                },
                            });

                        }
                    });
                },
                updateEdita: function () {
                    this.$validator.validateAll().then(function () {
                        if (!vmContext.errors.any()) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/pregunta-resp') !!}/' + vmContext.pregunta_resp.id,
                                data: {
                                    'pregunta_resp': vmContext.pregunta_resp,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Pregunta y Respuesta modificada satisfactoriamente');
                                    }
                                },
                            });

                        }
                    });
                },

            }
        });
    </script>
@endsection
