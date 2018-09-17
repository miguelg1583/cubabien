@extends('backend.layouts.master')

@section('title', 'Contactos')

@section('css')
@endsection

@section('title_content', 'Mensajes Recibidos')

@section('content')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Listado
                    {{--<small>tabs por idiomas</small>--}}
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="DTS_contactos" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
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
        $(document).ready(()=>{
            App.init("{{config('app.url')}}");
            App.initAjax();
            // App.initDatatable();
                $('#DTS_contactos').DataTable({
                    'paging': true,
                    'lengthMenu': [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true,
                    'language': {
                        'url': '{{config("app.url")}}' + '/backend/js/Spanish.json'
                    },
                    searchDelay: 800,
                    serverSide: true,
                    // order: [[5, 'asc']],
                    ajax: {
                        url: "{!! route('contact.list') !!}",
                        type: "POST",
                        // data: {"_token": $('meta[name="_token"]').attr("content")}
                    },

                    columns: [
                        {data: 'nombre'},
                        {data: 'email'},
                        {data: 'mensaje'},
                        {data: 'created_at'}
                    ],
                });
        });
    </script>
@endsection
