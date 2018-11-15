@extends('backend.layouts.master')

@section('title', 'Contactos')

@section('css')
@endsection

@section('title_content', 'Mensajes Recibidos')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bars"></i> Listado
                <small>los nuevos mensajes serán los primeros</small>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="DTS_contactos" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                <thead>
                <tr>
                    {{--<th>id</th>--}}
                    <th>Nombre</th>
                    <th>Atendido</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th>Recibido</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    {{--<th>id</th>--}}
                    <th>Nombre</th>
                    <th>Atendido</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th>Recibido</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(() => {
            App.init("{{config('app.url')}}");
            App.initAjax();
            // App.initDatatable();
            $('#DTS_contactos').DataTable({
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
                searchDelay: 800,
                serverSide: true,
                // order: [[0, 'desc']],
                ajax: {
                    url: "{!! route('contact.list') !!}",
                    type: "POST",
                },

                columns: [
                    {data: 'nombre'},
                    {data: 'atendido'},
                    {data: 'email'},
                    {data: 'mensaje'},
                    {
                        data: 'created_at',
                        order: 'desc'
                    }
                ],
                // columnDefs: [{targets: 0, visible: false}],

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
                            url: '/admin/contact/atendido/' + data.id,
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


        });


    </script>
@endsection
