@extends('backend.layouts.master')

@section('title', 'Tour - Editar')

@section('css')
@endsection

@section('title_content', 'Tour')

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
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.nb')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tour">Nombre <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="tour" class="form-control col-md-7 col-xs-12"
                                   name="tour"
                                   type="text"
                                   data-vv-scope="tour"
                                   v-model="tour.nb"
                                   v-validate="'required|min:5|max:150'">
                            <span class="help-block">@{{ errors.first('tour.nb') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.introd')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="introd">Introduccion
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <fe-summernote id="introd" class="form-control"
                                           name="introd"
                                           type="text" v-model="tour.introd"
                                           data-vv-scope="tour"
                                           v-validate="'required|min:5'"></fe-summernote>
                        </div>

                        <span class="help-block">@{{ errors.first('tour.introd') }}</span>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.num_dias')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Días
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="num_dias" class="form-control col-md-7 col-xs-12"
                                   name="num_dias"
                                   type="number"
                                   data-vv-scope="tour"
                                   v-model="tour.num_dias"
                                   v-validate="'required|integer|min_value:1'">
                            <span class="help-block">@{{ errors.first('tour.num_dias') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.num_noches')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Noches
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="num_noches" class="form-control col-md-7 col-xs-12"
                                   name="num_noches"
                                   type="number"
                                   data-vv-scope="tour"
                                   v-model="tour.num_noches"
                                   v-validate="'required|integer|min_value:1'">
                            <span class="help-block">@{{ errors.first('tour.num_noches') }}</span>
                        </div>
                    </div>

                    <div :class="{'item':true, 'form-group':true}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Día de Salida <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="radio" id="domingo_sal" value="0" v-model="tour.salida_dia_trad"
                                   checked>
                            <label for="domingo_sal">Dom</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="lunes_sal" value="1" v-model="tour.salida_dia_trad">
                            <label for="lunes_sal">Lun</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="martes_sal" value="2" v-model="tour.salida_dia_trad">
                            <label for="martes_sal">Mar</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="miercoles_sal" value="3" v-model="tour.salida_dia_trad">
                            <label for="miercoles_sal">Mié</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="jueves_sal" value="4" v-model="tour.salida_dia_trad">
                            <label for="jueves_sal">Jue</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="viernes_sal" value="5" v-model="tour.salida_dia_trad">
                            <label for="viernes_sal">Vie</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="sabado_sal" value="6" v-model="tour.salida_dia_trad">
                            <label for="sabado_sal">Sáb</label>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Día de Llegada <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="radio" id="domingo_lleg" value="0" v-model="tour.llegada_dia_trad">
                            <label for="domingo_lleg">Dom</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="lunes_lleg" value="1" v-model="tour.llegada_dia_trad">
                            <label for="lunes_lleg">Lun</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="martes_lleg" value="2" v-model="tour.llegada_dia_trad">
                            <label for="martes_lleg">Mar</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="miercoles_lleg" value="3" v-model="tour.llegada_dia_trad">
                            <label for="miercoles_lleg">Mié</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="jueves_lleg" value="4" v-model="tour.llegada_dia_trad">
                            <label for="jueves_lleg">Jue</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="viernes_lleg" value="5" v-model="tour.llegada_dia_trad">
                            <label for="viernes_lleg">Vie</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="sabado_lleg" value="6" v-model="tour.llegada_dia_trad">
                            <label for="sabado_lleg">Sáb</label>
                        </div>
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
            data: {
                tour: {!! json_encode($tour) !!}
            },
            watch: {
                'tour.num_dias': function () {
                    this.tour.num_noches = this.tour.num_dias - 1;
                },
            },
            computed: {
                isNoValido() {
                    let self = this;
                    if (self.errors.has('tour.*')) {
                        return true;
                    } else {
                        if (self.fields['$tour']) {
                            Object.keys(self.fields['$tour']).forEach(function (item) {
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
                    this.$validator.validate('tour.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/tour') !!}/' + vmContext.tour.id,
                                data: {
                                    'tour': vmContext.tour,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Tour modificado satisfactoriamente');
                                    window.location.replace(App.getBaseUrl() + '/admin/tour');
                                }
                            });

                        }
                    });
                },
                updateEdita: function () {
                    this.$validator.validate('tour.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'PUT',
                                url: '{!! url('/admin/tour') !!}/' + vmContext.tour.id,
                                data: {
                                    'tour': vmContext.tour,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    App.showNotiSuccess('Tour modificado satisfactoriamente');
                                }
                            });

                        }
                    });
                }
            }
        });
    </script>
@endsection
