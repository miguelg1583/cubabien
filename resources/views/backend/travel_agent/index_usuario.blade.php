@extends('backend.layouts.master')

@section('title', 'Usuarios de Agencias')

@section('css')
    {{--    <link href="{{assets_file('vendor/fileExtension/css/ft.css')}}" rel="stylesheet">--}}
@endsection

@section('title_content', 'Usuarios')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bars"></i> Listado
                <small>usuarios de las agencias autorizadas</small>
            </h2>
            <a href="{{route('agency_user.index_createUser')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div id="app" v-cloak>
                <table id="DTS_usuarios" class="table table-striped table-bordered dt-responsive nowrap"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Activo</th>
                        <th>Agencia</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Activo</th>
                        <th>Agencia</th>
                        <th>Operaciones</th>
                    </tr>
                    </tfoot>
                </table>
                <div id="AgentPassModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel2">Cambiar Contraseña de usuario @{{
                                    usuario.name }}</h4>
                            </div>
                            <div class="modal-body" id="show_modal_content">
                                <div class="row">
                                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('password')}">
                                        <label class="control-label col-md-5 col-sm-5 col-xs-12"
                                               for="password">Contraseña
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input id="password" class="form-control col-md-7 col-xs-12"
                                                   name="password"
                                                   type="text"
                                                   data-vv-as="Contraseña"
                                                   v-model="usuario.password"
                                                   v-validate="'required|min:5|max:30'">
                                            <span class="help-block">@{{ errors.first('password') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" id="show_footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal" id="actionModal"
                                        @click="cambiaPassword()" :disabled="errors.any()">Cambiar
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
                usuario: {
                    id: "",
                    name: "",
                    email: "",
                    password: ""
                }
            },
            methods: {
                preloadUser: function () {
                    let self = this;
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('agency_user.getUser') !!}',
                        data: {
                            'id': self.usuario.id
                        }
                    }).done(function (data) {
                        self.usuario.name = data.name;
                        self.usuario.email = data.email;
                        $('#AgentPassModal').modal('show');
                    });
                },
                cambiaPassword: function () {
                    let self = this;
                    this.$validator.validateAll().then(function (result) {
                        if(result){
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('agency_user.cambiaPassword') !!}',
                                data: {
                                    'usuario': self.usuario
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema intente nuevamente');
                                } else {
                                    self.usuario.id = "";
                                    self.usuario.name = "";
                                    self.usuario.email = "";
                                    self.usuario.password = "";
                                    App.showNotiSuccess('Cambiada la contraseña satisfactoriamente');
                                    $('#DTS_usuarios').DataTable().ajax.reload();
                                }
                            });
                        }
                    });
                },
                cargaDatatable: function () {
                    $('#DTS_usuarios').DataTable({
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
                            url: "{!! route('agency_user.list') !!}",
                            type: "POST",
                        },
                        columns: [
                            {data: 'name'},
                            {data: 'email'},
                            {data: 'activo'},
                            {data: 'agency.name', name: 'agency_id'},
                            {data: 'operaciones'},
                        ],
                        // rowGroup: {
                        //     dataSrc: 'agency.name',
                        //     // startRender: function ( rows, group ) {
                        //     //     return '<b>Agencia:</b> '+ group;
                        //     // },
                        // },
                        // columnDefs: [{targets: 3, visible: false}],
                        rowCallback: function (row, data) {
                            // console.log('funcion rowCallback row', row);
                            // console.log('funcion rowCallback data', data.id);
                            $(row).find('#check' + data.id).bootstrapToggle({
                                on: 'Si',
                                off: 'No',
                                onstyle: 'success',
                                offstyle: 'danger',
                                size: 'mini'
                            }).change(() => {
                                $.ajax({
                                    type: 'PUT',
                                    url: '/admin/agencia/usuario/activo/' + data.id,
                                    data: {
                                        'id': data.id,
                                    },
                                    success: function (data) {
                                        if ((data.errors)) {
                                            console.log(data);
                                            App.showNotiError('Ha ocurrido un problema en el servidor');
                                        } else {
                                            App.showNotiSuccess('Cambio de estado realizado correctamente')
                                        }
                                    }
                                });
                            });
                            // console.log('esta el ', data.id, data.uid);
                        }
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

        //seteo agencia en data para ejecutar metodo
        $(document).on("click", ".cambia-password", function () {
            vmContext.usuario.id = $(this).data("id");
            vmContext.preloadUser();
        });
    </script>
@endsection
