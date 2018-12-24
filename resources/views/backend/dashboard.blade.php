@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('title_content', 'Dashboard')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <div class="col-md-6">
                <h2>Contactos
                    <small>clientes que han llenado el formulario de contacto</small>
                </h2>
            </div>
            {{--<div class="col-md-6">--}}
                {{--<div id="reportrange" class="pull-right"--}}
                     {{--style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">--}}
                    {{--<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>--}}
                    {{--<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <canvas id="lineChart"></canvas>


            {{--<ul>--}}
            {{--<li>Una row con mapa del mundo y numero de visitas</li>--}}
            {{--<li>Grafico de linea con # de veces que se ha entrado</li>--}}
            {{--<li>Una columna por tipo de servicio con grafico de lo mas visto</li>--}}
            {{--<li></li>--}}
            {{--<li></li>--}}
            {{--<li></li>--}}
            {{--</ul>--}}
        </div>
    </div>


@endsection

@section('js')
    <script src="{{assets_file('vendor/Chart.js/dist/Chart.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            if ($('#lineChart').length ){


                let ctx = document.getElementById("lineChart");
                let lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [{
                            label: "My First dataset",
                            backgroundColor: "rgba(38, 185, 154, 0.31)",
                            borderColor: "rgba(38, 185, 154, 0.7)",
                            pointBorderColor: "rgba(38, 185, 154, 0.7)",
                            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointBorderWidth: 1,
                            data: [31, 74, 6, 39, 20, 85, 7]
                        }, {
                            label: "My Second dataset",
                            backgroundColor: "rgba(3, 88, 106, 0.3)",
                            borderColor: "rgba(3, 88, 106, 0.70)",
                            pointBorderColor: "rgba(3, 88, 106, 0.70)",
                            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(151,187,205,1)",
                            pointBorderWidth: 1,
                            data: [82, 23, 66, 9, 99, 4, 2]
                        }]
                    },
                });

            }
        });

    </script>
@endsection
