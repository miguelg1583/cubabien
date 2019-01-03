@extends('backend.layouts.master')

@section('title', 'Agencias de Viaje')

@section('css')
    {{--    <link href="{{assets_file('vendor/fileExtension/css/ft.css')}}" rel="stylesheet">--}}
@endsection

@section('title_content', 'Agencias')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bars"></i> Listado
                <small>agencias autorizadas a trabajar en el sitio</small>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div id="app" v-cloak>
                <table id="DTS_agencias" class="table table-striped table-bordered dt-responsive nowrap"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Descuento</th>
                        <th>Teléfono</th>
                        <th>Nombre del Dueño</th>
                        <th>Título</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Descuento</th>
                        <th>Teléfono</th>
                        <th>Nombre del Dueño</th>
                        <th>Título</th>
                        <th>Operaciones</th>
                    </tr>
                    </tfoot>
                </table>
                <div id="AgentOperacionModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel2">Cambio de Comisión para Agencia @{{
                                    agencia.name }}</h4>
                            </div>
                            <div class="modal-body" id="show_modal_content">
                                <div class="row">
                                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('porciento_descuento')}">
                                        <label class="control-label col-md-5 col-sm-5 col-xs-12"
                                               for="porciento_descuento">Comisión, porciento de descuento
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input id="porciento_descuento" class="form-control col-md-7 col-xs-12"
                                                   name="porciento_descuento"
                                                   type="number"
                                                   data-vv-as="Porciento"
                                                   v-model="agencia.porciento_descuento"
                                                   v-validate="'required|decimal:2|min_value:1|max_value:100'">
                                            <span class="help-block">@{{ errors.first('porciento_descuento') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" id="show_footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal" id="actionModal"
                                        @click="cambiaPorciento()" :disabled="errors.any()">Cambiar
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')
    {{--    <link href="{{assets_file('vendor/fileExtension/js/ft.js')}}" rel="stylesheet" media="print">--}}
    <script type="text/javascript">
        Vue.use(VeeValidate, {locale: 'es'});
        window.vmContext = new Vue({
            el: "#app",
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                agencia: {
                    id: "",
                    name: "",
                    email: "",
                    porciento_descuento: ""
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
                preloadAgencia: function (id) {
                    let self = this;
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('agency.getAgencia') !!}',
                        data: {
                            'id': id
                        }
                    }).done(function (data) {
                        self.agencia.name = data.name;
                        self.agencia.email = data.email;
                        self.agencia.porciento_descuento = data.porciento_descuento;
                        $('#AgentOperacionModal').modal('show');
                    });
                },
                cambiaPorciento: function () {
                    let self = this;
                    this.$validator.validateAll().then(function (result) {
                        if(result){
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('agency.cambiaPorciento') !!}',
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
                                    self.agencia.porciento_descuento = "";
                                    App.showNotiSuccess('Cambiado Porciento satisfactoriamente');
                                    $('#DTS_agencias').DataTable().ajax.reload();
                                }
                            });
                        }
                    });
                },
                cargaDatatable: function () {
                    $('#DTS_agencias').DataTable({
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
                            url: "{!! route('agency.list') !!}",
                            type: "POST",
                        },

                        columns: [
                            {data: 'name'},
                            {data: 'address'},
                            {data: 'email'},
                            {data: 'porciento_descuento'},
                            {data: 'phone_num'},
                            {data: 'owner_name'},
                            {data: 'title'},
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

        //seteo agencia en data para con wathcer trabajar
        $(document).on("click", ".cambia-porciento", function () {
            vmContext.agencia.id = $(this).data("id");
        });
    </script>
@endsection
