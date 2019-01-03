@extends('backend.layouts.master')

@section('title', 'Usuarios de Agencias - Crear')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/select2/css/select2.min.css')}}"/>

@endsection

@section('title_content', 'Usuarios de Agencias')

@section('content')
    <div id="app" v-cloak>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-file-code-o"></i> Agregar
                    <small>usuario de una agencia</small>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" novalidate autocomplete="off">
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('usuario.agencia')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agencia">Agencia <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select2 id="agencia" class="form-control col-md-4 col-xs-12"
                                     name="agencia"
                                     v-model="usuario.agencia"
                                     :values="agencias.text"
                                     :options="agencias"
                                     :allowclear="false">
                            </select2>
                            <span class="help-block">@{{ errors.first('usuario.agencia') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('usuario.nombre')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="nombre" class="form-control col-md-4 col-xs-12"
                                   name="nombre"
                                   type="text" v-model="usuario.nombre"
                                   data-vv-scope="usuario"
                                   v-validate="'required|min:3|max:100'">
                            <span class="help-block">@{{ errors.first('usuario.nombre') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('usuario.email')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" class="form-control col-md-4 col-xs-12"
                                   name="email"
                                   type="text" v-model="usuario.email"
                                   data-vv-scope="usuario"
                                   v-validate="'required|email'">
                            <span class="help-block">@{{ errors.first('usuario.email') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('usuario.password')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" class="form-control col-md-4 col-xs-12"
                                   name="password"
                                   type="text" v-model="usuario.password"
                                   data-vv-scope="usuario"
                                   v-validate="'required|min:6'">
                            <span class="help-block">@{{ errors.first('usuario.password') }}</span>
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
    <script src="{{assets_file('vendor/select2/js/select2.full.min.js')}}"></script>
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
                App.initAjax();
            },
            data: {
                agencias: {!! json_encode($agencias) !!},
                usuario: {
                    agencia: "",
                    nombre: "",
                    email: "",
                    password: ""
                }
            },
            computed: {
                isNoValido() {
                    // return Object.keys(this.fields).some(key => key!=='$modal_trad' && this.fields[key].validated === false) || this.errors.any();
                    let self = this;
                    if (self.errors.any('$usuario')) {
                        return true;
                    } else {
                        if (this.fields['$usuario']) {
                            Object.keys(this.fields['$usuario']).forEach(function (item) {
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
                    this.usuario.agencia = "{!! $agencias->count()>0 ? $agencias[0]->id : '' !!}";
                    this.usuario.nombre = "";
                    this.usuario.email = "";
                    this.usuario.password = "";

                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset('usuario');
                            this.errors.clear();
                        });
                },
                createLista: function () {
                    this.$validator.validateAll('usuario').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('agency_user.createUser') !!}',
                                data: {
                                    'usuario': vmContext.usuario,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Usuario creado satisfactoriamente');
                                        window.location.replace(App.getBaseUrl() + '/admin/agencia/usuarios');
                                    }
                                },
                            });

                        }
                    });
                },
                createAgrega: function () {
                    this.$validator.validateAll('usuario').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('agency_user.createUser') !!}',
                                data: {
                                    'usuario': vmContext.usuario,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Usuario creado satisfactoriamente');
                                        vmContext.setInicial();
                                    }
                                },
                            });

                        }
                    });
                }
            }
        });
    </script>
@endsection
