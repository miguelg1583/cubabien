@extends('backend.layouts.master')

@section('title', 'Fechas de Tours - Crear')

@section('css')
@endsection

@section('title_content', 'Calendarios de Tour y Precios')

@section('content')
    <div id="app" v-cloak>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-file-code-o"></i> Agregar
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('fecha.tour')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tour">Tour <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="tour" class="form-control col-md-7 col-xs-12"
                                    name="tour"
                                    data-vv-scope="fecha"
                                    v-model="fecha.tour_id"
                                    v-validate="'required'">
                                <option disabled value="">Seleccione un Tour</option>
                                <option v-for="(val, index) in tours" :value="val.id">@{{ val.text }}</option>
                            </select>
                            <span class="help-block">@{{ errors.first('fecha.tour') }}</span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Desde - Hasta
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="fecha-rango"
                                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('fecha.precio_single')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="precio_sigle">Precio
                            Single Pax
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="precio_single" class="form-control col-md-7 col-xs-12"
                                   name="precio_single"
                                   type="text"
                                   data-vv-scope="fecha"
                                   v-model="fecha.precio_s_pax"
                                   v-validate="'required|decimal:2'">
                            <span class="help-block">@{{ errors.first('fecha.precio_single') }}</span>
                        </div>
                    </div>
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('fecha.precio_double')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="precio_double">Precio
                            Double Pax
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="precio_double" class="form-control col-md-7 col-xs-12"
                                   name="precio_double"
                                   type="text"
                                   data-vv-scope="fecha"
                                   v-model="fecha.precio_d_pax"
                                   v-validate="'required|decimal:2'">
                            <span class="help-block">@{{ errors.first('fecha.precio_double') }}</span>
                        </div>
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
            mounted() {
                this.initDateRangePicker();
            },

            data: {
                tours: {!! json_encode($tours) !!},
                fecha: {
                    desde: "",
                    hasta: "",
                    precio_s_pax: "",
                    precio_d_pax: "",
                    tour_id: ""
                }
            },
            computed: {
                isNoValido() {
                    // return Object.keys(this.fields).some(key => key!=='$modal_trad' && this.fields[key].validated === false) || this.errors.any();
                    let self = this;
                    if (self.errors.has('fecha.*')) {
                        return true;
                    } else {
                        if (self.fields['$fecha']) {
                            Object.keys(self.fields['$fecha']).forEach(function (item) {
                                if (item.validated === false || item.touched === false) {
                                    return true;
                                }
                            });
                        }
                    }
                    return self.fecha.desde === "" || self.fecha.hasta === "";

                },


            },
            methods: {
                setInicial: function () {
                    this.fecha = {
                        desde: "",
                        hasta: "",
                        precio_s_pax: "",
                        precio_d_pax: "",
                        tour_id: ""
                    };
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset().then(() => {
                                this.errors.clear()
                            });
                            // this.errors.clear();
                        });
                },
                createLista: function () {
                    this.$validator.validate('fecha.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('calendario-tour.store') !!}',
                                data: {
                                    'fecha': vmContext.fecha,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema Revise los datos');
                                } else {
                                    App.showNotiSuccess('Calendario creado satisfactoriamente');
                                    window.location.replace("{!! route('calendario-tour.index') !!}");
                                }
                            });

                        }
                    });
                }
                ,
                createAgrega: function () {
                    this.$validator.validate('fecha.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('calendario-tour.store') !!}',
                                data: {
                                    'fecha': vmContext.fecha,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema Revise los datos');
                                } else {
                                    App.showNotiSuccess('Tour creado satisfactoriamente');
                                    vmContext.setInicial();
                                }
                            });

                        }
                    });
                },
                initDateRangePicker: function () {
                    $('#fecha-rango').daterangepicker({
                        autoUpdateInput: false,
                        alwaysShowCalendars: true,
                        // minDate: start,
                        // maxDate: end,
                        // ranges: {
                        //     'Hoy': [moment(), moment()],
                        //     'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        //     'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
                        //     'Últimos 30 Days': [moment().subtract(29, 'days'), moment()],
                        //     'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        //     'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        // },
                        "locale": {
                            "format": "ddd, MMM DD, YYYY",
                            "separator": " - ",
                            "applyLabel": "Aceptar",
                            "cancelLabel": "Cancelar",
                            "fromLabel": "Desde",
                            "toLabel": "Hasta",
                            "customRangeLabel": "Período Personalizado",
                            "weekLabel": "Sem",
                            "daysOfWeek": [
                                "Do",
                                "Lu",
                                "Ma",
                                "Mi",
                                "Ju",
                                "Vi",
                                "Sá"
                            ],
                            "monthNames": [
                                "Enero",
                                "Febrero",
                                "Marzo",
                                "Abril",
                                "Mayo",
                                "Junio",
                                "Julio",
                                "Agosto",
                                "Septiembre",
                                "Octubre",
                                "Noviembre",
                                "Diciembre"
                            ],
                            "firstDay": 1
                        },
                    });
                }
            }
        });

        $('#fecha-rango').on('cancel.daterangepicker', function (ev, picker) {
            //do something, like clearing an input
            $('#fecha-rango').find('span').empty();
        }).on('apply.daterangepicker', function (ev, picker) {
            $('#fecha-rango').find('span').html(picker.startDate.format('ddd DD/MM/YYYY') + ' - ' + picker.endDate.format('ddd DD/MM/YYYY'));
            // console.log(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
            // console.log(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
            vmContext.fecha.desde = picker.startDate.format('DD/MM/YYYY');
            vmContext.fecha.hasta = picker.endDate.format('DD/MM/YYYY');
        });

        // $('#fecha-rango').on('apply.daterangepicker', function(ev, picker) {
        //     $('#fecha-rango').find('span').html(picker.startDate.format('ddd DD/MM/YYYY') + ' - ' + picker.endDate.format('ddd DD/MM/YYYY'));
        //     console.log(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
        //     console.log(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
        // });
    </script>
@endsection
