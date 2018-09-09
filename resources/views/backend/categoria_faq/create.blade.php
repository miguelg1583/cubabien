@extends('backend.layouts.master')

@section('title', 'Categoría - Crear')

@section('css')
@endsection

@section('title_content', 'Categoría')

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
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('categoria.nombre')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group">
                                <input id="nombre" class="form-control col-md-4 col-xs-12"
                                       name="nombre"
                                       type="text" v-model="categoria.nb.valor"
                                       data-vv-scope="categoria"
                                       v-validate="'required'">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Nombre')" :disabled="valLLeno">
                                        <span class="fa fa-language"></span>
                                    </button>
                                </span>
                            </div>
                            <span class="help-block">@{{ errors.first('categoria.nombre') }}</span>
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
                categoria: {
                    nb: {
                        valor: "",
                        // include----------------------------
                        @include('backend.traducciones.partial.vdata_trad')
                        //cierra include----------------------------
                    },
                    visitas: ""
                },
                // include----------------------------
                @include('backend.traducciones.partial.vdata_trad')
                //cierra include----------------------------
            },
            computed: {
                isNoValido() {
                    // return Object.keys(this.fields).some(key => key!=='$modal_trad' && this.fields[key].validated === false) || this.errors.any();
                    let self = this;
                    if (self.errors.any('$categoria')) {
                        return true;
                    } else {
                        if(this.fields['$categoria']){
                            Object.keys(this.fields['$categoria']).forEach(function (item) {
                                if (item.validated === false) {
                                    return true;
                                }
                            });
                        }
                    }
                    return false;
                },
                valLLeno() {
                    return this.categoria.nb.valor === "";
                },
                // isValidoModal() {
                //     // return Object.keys(this.fields.$modal_trad).some(key => this.fields.$modal_trad[key].validated === false) || this.errors.has('mod_trad.*')
                //     return this.errors.has('$mod_trad.*');
                // },
            },
            methods: {
                setInicial: function () {
                    self = this;
                    this.categoria.nb = {
                        valor: "",
                        traduccion: {
                            // group: "",
                            // key: "",
                            text: []
                        }
                    };
                    this.idiomas.forEach(function (item) {
                        self.categoria.nb.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                    });
                    this.categoria.visitas = "";

                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset('categoria');
                            this.errors.clear();
                        });
                },
                //include --------------------------------------
                @include('backend.traducciones.partial.vmethod_trad')
                //cierra  include --------------------------------------
                createLista: function () {
                    this.$validator.validateAll('categoria').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('categoria-faq.store') !!}',
                                data: {
                                    'categoria': vmContext.categoria,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Categoria creada satisfactoriamente');
                                        window.location.replace(App.getBaseUrl() + '/admin/categoria-faq');
                                    }
                                },
                            });

                        }
                    });
                },
                createAgrega: function () {
                    this.$validator.validateAll('categoria').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('categoria-faq.store') !!}',
                                data: {
                                    'categoria': vmContext.categoria,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Categoria creada satisfactoriamente');
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
                            // eslint-disable-next-line
                            vmContext.categoria.nb.traduccion = vmContext.traduccion;
                            $("#tradModal").modal("hide");
                            this.setInicialTrad();
                        }

                    });
                },
            }
        });
    </script>
@endsection
