@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/select2/css/select2.min.css')}}"/>
@endsection

@section('title_content', 'Dashboard')

@section('content')
    <div id="app" v-cloak>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Contactos
                            <small>clientes que han llenado el formulario de contacto</small>
                        </h2>
                        <div class="pull-right">
                            <select2 id="sel_anno" class="form-control"
                                     name="sel_anno"
                                     v-model="contact_line.anno"
                                     :options="contact_line.annos"
                                     :allowclear="false">
                            </select2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {{--<div class="row">--}}
                            <canvas id="contactLineChart"></canvas>
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tours Visitas
                            <small>los tour que mas entran los usuarios</small>
                        </h2>
                        <div class="pull-right" style="height: 38px">

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {{--<div class="row">--}}
                            <canvas id="tourVisitasRadar"></canvas>
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--<ul>--}}
{{--<li>Una row con mapa del mundo y numero de visitas</li>--}}
{{--<li>Grafico de linea con # de veces que se ha entrado</li>--}}
{{--<li>Una columna por tipo de servicio con grafico de lo mas visto</li>--}}
{{--<li></li>--}}
{{--<li></li>--}}
{{--<li></li>--}}
{{--</ul>--}}
@section('js')
    <script src="{{assets_file('vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{assets_file('vendor/Chart.js/dist/Chart.min.js')}}"></script>

    <script type="text/javascript">
        window.vmContext = new Vue({
            el: "#app",
            data: {
                contact_line: {
                    anno: '',
                    annos: {!! json_encode($annos) !!}
                },
            },
            methods: {
                cargaContactLine: function (anno) {
                    if ($('#contactLineChart').length) {
                        $.ajax({
                            type: 'POST',
                            url: '{!! route('dashboard.contact') !!}',
                            data: {
                                'anno': parseInt(anno)
                            }
                        }).done(function (data) {
                            let lineChart = new Chart(document.getElementById("contactLineChart"), {
                                type: 'line',
                                data: {
                                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                                    datasets: [{
                                        label: anno,
                                        backgroundColor: "rgba(38, 185, 154, 0.31)",
                                        borderColor: "rgba(38, 185, 154, 0.7)",
                                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
                                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                                        pointHoverBackgroundColor: "#fff",
                                        pointHoverBorderColor: "rgba(220,220,220,1)",
                                        pointBorderWidth: 1,
                                        data: data
                                    }]
                                },
                            });
                        });
                    }
                },
                cargaTourVisitasRadar: function(){
                    if ($('#tourVisitasRadar').length ){
                        $.ajax({
                            type: 'POST',
                            url: '{!! route('dashboard.tour_visitas') !!}',
                        }).done(function (data) {
                            let radarChart = new Chart(document.getElementById("tourVisitasRadar"), {
                                type: 'radar',
                                data: {
                                    labels: data.tours,
                                    datasets: [{
                                        label: "Visitas",
                                        backgroundColor: "rgba(38, 185, 154, 0.2)",
                                        borderColor: "rgba(38, 185, 154, 0.85)",
                                        pointColor: "rgba(38, 185, 154, 0.85)",
                                        pointStrokeColor: "#fff",
                                        pointHighlightFill: "#fff",
                                        pointHighlightStroke: "rgba(151,187,205,1)",
                                        data: data.visitas
                                    }]
                                },
                            });
                        });
                    }
                },
                setAnno: function () {
                    let d = new Date();
                    let pos_anno = $.inArray(d.getFullYear(), this.contact_line.annos);
                    if (pos_anno === -1) {
                        this.contact_line.anno = this.contact_line.annos[0] + "";
                    } else {
                        this.contact_line.anno = this.contact_line.annos[pos_anno] + "";
                    }
                    return pos_anno;
                }
            },
            watch: {
                'contact_line.anno': function (despues, antes) {
                    if (antes !== "") {
                        this.cargaContactLine(despues);
                    }
                }
            },
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initAjax();
            },
            mounted: function () {
                this.setAnno();
                this.cargaContactLine(this.contact_line.anno);
                this.cargaTourVisitasRadar();
            },

        });
    </script>

@endsection
