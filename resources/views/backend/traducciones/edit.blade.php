@extends('backend.layouts.master')

@section('title', 'Traducciones - Editar')

@section('css')
@endsection

@section('title_content', 'Traducciones')

@section('content')
    <div id="app" v-cloak>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-file-code-o"></i> Editar
                    <small>tabs por idiomas</small>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel">
                    <ul id="tradTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" v-for="(val, index) in idiomas" :class="{ 'active': index==0 }"><a
                                    :href="'#tab_'+val.sigla" :id="val.sigla+'-tab'" role="tab"
                                    data-toggle="tab" :aria-expanded="index==0 ? 'true' : 'false'">@{{ val.nombre }}</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" v-for="(val, index) in idiomas"
                             :class="{'tab-pane': true, 'fade': true, 'active': index==0, in: index==0}"
                             :id="'tab_'+val.sigla"
                             :aria-labelledby="val.sigla+'-tab'">
                            <form class="form-horizontal form-label-left" novalidate autocomplete="off">

                                <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('grupo')}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grupo">Grupo <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input :id="'grupo-'+creaRandomStr(4)" class="form-control col-md-7 col-xs-12 autocomplete_field"
                                               name="grupo"
                                               type="text" v-model="traduccion.group"
                                               v-validate="'required|alpha_dash|min:3|max:50'" autocomplete="off">
                                        <span class="help-block">@{{ errors.first('grupo') }}</span>
                                    </div>
                                </div>
                                <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('llave')}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="llave">Llave <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="llave" class="form-control col-md-7 col-xs-12" name="llave"
                                               type="text" v-model="traduccion.key"
                                               v-validate="'required|alpha_dash|min:1|max:50'">
                                        <span class="help-block">@{{ errors.first('llave') }}</span>
                                    </div>
                                </div>
                                <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('valor_'+val.sigla)}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" :for="'valor_'+val.sigla">Valor
                                        <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{--<fe-summernote data-vv-scope="help" v-validate="'required'"--}}
                                        {{--v-model="help.content" name="valor"></fe-summernote>--}}
                                        <fe-summernote v-validate="'required'"
                                                       v-model="traduccion.text[index].text"
                                                       :name="'valor_'+val.sigla"></fe-summernote>
                                        <span class="help-block">@{{ errors.first('valor_'+val.sigla) }}</span>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-3">--}}
                                {{--<button type="submit" class="btn btn-primary" :disabled="errors.any()"><span class='fa fa-list'></span>Guardar y Regresar al listado</button>--}}
                                {{--<button id="send" type="submit" class="btn btn-success" :disabled="errors.any()"><span class='fa fa-check'></span>Guardar y Agregar otro</button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </form>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary" :disabled="isValido"
                                    v-on:click.prevent="updateTradLista()"><span
                                        class='fa fa-list'></span>Guardar y Regresar al listado
                            </button>
                            <button id="send" type="submit" class="btn btn-success" :disabled="isValido"
                                    v-on:click.prevent="updateTradEdita()"><span
                                        class='fa fa-check'></span>Guardar
                            </button>
                        </div>
                    </div>
                </div>

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
                // this.setInicial();
                App.initAjax();
            },
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                traduccion: {!! json_encode($trad) !!}
            },
            computed: {
                isValido() {
                    this.$nextTick()
                        .then(() => {
                            return Object.keys(this.fields).some(key => this.fields[key].validated === false) || this.errors.any()
                        });
                }
            },
            methods: {
                creaRandomStr: function (length) {
                    let str = "";
                    for (; str.length < length; str += Math.random().toString(36).substr(2)) ;
                    return str.substr(0, length);
                },
                updateTradLista: function () {
                    this.$validator.validateAll().then(function () {
                        if (!vmContext.errors.any()) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/traduccion') !!}/'+vmContext.traduccion.id,
                                data: {
                                    'traduccion': vmContext.traduccion,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        if (data.errors.key) {
                                            App.showNotiNotice('Problema de Validación');
                                            const fieldError = {
                                                field: 'llave',
                                                msg: 'Esta llave con este grupo ya esta usada.'
                                            };
                                            vmContext.errors.add(fieldError);
                                        } else {
                                            App.showNotiError('Ha ocurrido un problema en el servidor');
                                        }
                                    } else {
                                        App.showNotiSuccess('Traducción modificada satisfactoriamente');
                                        window.location.replace(App.getBaseUrl() + '/admin/traduccion');
                                    }
                                },
                            });

                        }
                    });
                },
                updateTradEdita: function () {
                    this.$validator.validateAll().then(function () {
                        if (!vmContext.errors.any()) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/traduccion') !!}/'+vmContext.traduccion.id,
                                data: {
                                    'traduccion': vmContext.traduccion,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        if (data.errors.key) {
                                            App.showNotiNotice('Problema de Validación');
                                            const fieldError = {
                                                field: 'llave',
                                                msg: 'Esta llave con este grupo ya esta usada.'
                                            };
                                            vmContext.errors.add(fieldError);
                                        } else {
                                            App.showNotiError('Ha ocurrido un problema en el servidor');
                                        }
                                    } else {
                                        App.showNotiSuccess('Traducción modificada satisfactoriamente');
                                    }
                                },
                            });

                        }
                    });
                },
            },

            // mounted: function () {
            //     App.initDatatable();
            // },
        });

        //autocomplete grupo
        $('.autocomplete_field').autocomplete({
            minChars: 0,
            serviceUrl: '{{route('buscaGrupos')}}',
            paramName: 'q',
            deferRequestBy: 500,
            formatResult: function (suggestion, currentValue) {
                // console.log(suggestion);
                return suggestion.value;
            },
            onSelect: function (suggestion) {
                vmContext.traduccion.group = suggestion.value;
                // $(this).val(suggestion.value);
            },
            onSearchStart: function (params) {
                $(this).addClass("loadinggif");
            },
            onSearchComplete: function (params) {
                $(this).removeClass("loadinggif");
            },
            // onSearchError: function (params) {
            //     $(this).removeClass("loadinggif");
            //     toastr.error('Error de conexion, pruebe recargar la página', 'Error', {timeOut: 5000});
            //     console.log(params);
            // }

        }).on('focus', function () {
            $(this).keydown();
        });
    </script>
@endsection
