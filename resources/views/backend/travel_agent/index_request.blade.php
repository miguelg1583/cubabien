@extends('backend.layouts.master')

@section('title', 'Agentes - Solicitudes')

@section('css')
    {{--    <link href="{{assets_file('vendor/fileExtension/css/ft.css')}}" rel="stylesheet">--}}
@endsection

@section('title_content', 'Solicitudes')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bars"></i> Listado
                <small>agencias de viajes interesadas, las nuevas solicitudes serán las primeras</small>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div id="app" v-cloak>
                <table id="DTS_agent-request" class="table table-striped table-bordered dt-responsive nowrap"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Autorizada</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>D&B #</th>
                        <th>Teléfono</th>
                        <th>Año Negocio</th>
                        <th>Travel Permit File</th>
                        <th>IATA #</th>
                        <th>Nombre del Dueño</th>
                        <th>Título</th>
                        <th>Ventas Anuales</th>
                        <th>Recibido</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Autorizada</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>D&B #</th>
                        <th>Teléfono</th>
                        <th>Año Negocio</th>
                        <th>Travel Permit File</th>
                        <th>IATA #</th>
                        <th>Nombre del Dueño</th>
                        <th>Título</th>
                        <th>Ventas Anuales</th>
                        <th>Recibido</th>
                        <th>Operaciones</th>
                    </tr>
                    </tfoot>
                </table>
                @include('backend.travel_agent.operacion_modal')
            </div>
        </div>
    </div>



@endsection

@section('js')
    {{--    <link href="{{assets_file('vendor/fileExtension/js/ft.js')}}" rel="stylesheet" media="print">--}}
    <script type="text/javascript">
        window.vmContext = new Vue({
            el: "#app",
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                agencia: {
                    id: "",
                    name: "",
                    email: "",
                    user_name: "",
                    password: ""
                }
            },
            watch: {
                'agencia.id': function (despues, antes) {
                    if (despues !== "") {
                        this.preloadAgencia(despues);
                    }
                }
            },
            methods: {
                preloadAgencia: function(id){
                    let self = this;
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('travel-agent.preloadAgencia') !!}',
                        data: {
                            'id': id
                        }
                    }).done(function (data) {
                        self.agencia.name = data.name;
                        self.agencia.email = data.email;
                        self.agencia.username= data.username;
                        self.agencia.password = data.password;
                        $('#AgentOperacionModal').modal('show');
                    });
                },
                autorizaAgencia: function(){
                    let self = this;
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('travel-agent.autorizaAgencia') !!}',
                        data: {
                            'agencia': self.agencia
                        }
                    }).done(function (data) {
                        if (data.errors) {
                            console.log(data);
                            App.showNotiError('Ha ocurrido un problema intente nuevamente');
                        } else {
                            self.agencia.id = "";
                            self.agencia.name = "";
                            self.agencia.email = "";
                            self.agencia.username= "";
                            self.agencia.password = "";
                            App.showNotiSuccess('Agencia autorizada satisfactoriamente');
                            $('#DTS_agent-request').DataTable().ajax.reload();
                        }
                    });
                },
                getMomentFormat: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').format("dddd, DD/MM/YYYY h:mm a");
                },
                cargaDatatable: function () {
                    $('#DTS_agent-request').DataTable({
                        'paging': true,
                        'lengthMenu': [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                        'lengthChange': true,
                        'searching': true,
                        // 'ordering': true,
                        'info': true,
                        'autoWidth': true,
                        'language': {
                            'url': '{{config("app.url")}}' + '/backend/js/Spanish.json'
                        },
                        // 'responsive': true,
                        searchDelay: 800,
                        serverSide: true,
                        // order: [[0, 'desc']],
                        ajax: {
                            url: "{!! route('travel-agent.request.list') !!}",
                            type: "POST",
                        },

                        columns: [
                            {data: 'name'},
                            {
                                data: 'autorizada',
                                orderable: false,
                                searchabke: false
                            },
                            {data: 'address'},
                            {data: 'email'},
                            {data: 'd_b_num'},
                            {data: 'phone_num'},
                            {data: 'year_business'},
                            {data: 'travel_permit_filename'},
                            {data: 'iata_num'},
                            {data: 'owner_name'},
                            {data: 'title'},
                            {data: 'anual_sales_volume'},
                            {data: 'created_at'},
                            {data: 'operaciones'},
                        ],
                    });
                }
            },
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initAjax();
            },
            mounted: function () {
                this.cargaDatatable();
            },

        });

        //seteo agencia request para con wathcer trabajar
        $(document).on("click", ".activar", function () {
            vmContext.agencia.id = $(this).data("id");
        });
    </script>
@endsection
