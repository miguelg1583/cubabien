@extends('backend.layouts.master')

@section('title', 'Categoría - Editar')

@section('css')
@endsection

@section('title_content', 'Categoría')

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
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('categoria.nombre')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="nombre" class="form-control col-md-7 col-xs-12"
                                   name="nombre"
                                   type="text" v-model="categoria.nb.valor"
                                   data-vv-scope="categoria"
                                   v-validate="'required|max:190'">
                            <span class="help-block">@{{ errors.first('categoria.nombre') }}</span>
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
                categoria: {
                    id: "",
                    nb: {
                        valor: "",
                    },
                },
            },
            computed: {
                isNoValido() {
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

            },
            methods: {
                setInicial: function () {
                    self = this;
                    this.categoria.id = "{!! $categ->id !!}";
                    this.categoria.nb.valor = "{!! $categ->nb !!}";
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset('categoria');
                            this.errors.clear();
                        });
                },
                updateLista: function () {
                    this.$validator.validateAll().then(function () {
                        if (!vmContext.errors.any()) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/categoria-faq') !!}/'+vmContext.categoria.id,
                                data: {
                                    'categoria': vmContext.categoria,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Categoría modificada satisfactoriamente');
                                        window.location.replace(App.getBaseUrl() + '/admin/categoria-faq');
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
                                url: '{!! url('/admin/categoria-faq') !!}/'+vmContext.categoria.id,
                                data: {
                                    'categoria': vmContext.categoria,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Categoría modificada satisfactoriamente');
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
