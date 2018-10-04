@extends('backend.layouts.master')

@section('title', 'Calendarios')

@section('css')
@endsection

@section('title_content', 'Calendarios y Precios de los Tours')

@section('content')
        @include('backend.layouts.delete_modal')
        @include('backend.layouts.show_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Listado</h2>
                <a href="{{route('calendario-tour.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="calendario_tour_DTG" class="table table-striped table-bordered dt-responsive nowrap"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Tour</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Precio Single</th>
                        <th>Precio Double</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Tour</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Precio Single</th>
                        <th>Precio Double</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th>Operaciones</th>
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
            $('#calendario_tour_DTG').DataTable({
                'paging': true,
                'responsive': true,
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
                    url: "{!! route('calendario-tour.list') !!}",
                    type: "POST",
                    // data: {"_token": $('meta[name="_token"]').attr("content")}
                },
                columns: [
                    {data: 'tour.nb'},
                    {data: 'desde'},
                    {data: 'hasta'},
                    {data: 'precio_s_pax'},
                    {data: 'precio_d_pax'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    {data: 'operaciones'}
                ],
                order: [[0, 'asc'],[1, 'desc']],
                rowGroup: {
                    dataSrc: 'tour.nb'
                },
                columnDefs: [{targets: 0, visible: false}],
            });
        });


        //delete
        let id = '';
        let indexPreg = '';
        $(document).on("click", ".delete-modal", function () {
            id = $(this).data("id");
            indexPreg = $(this).data("index");
        });
        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/calendario-tour') !!}');
            vmContext.itinerarios.splice(indexPreg, 1);
            $('#calendario_tour_DTG').DataTable().row(indexPreg).remove().draw(true);
        });
    </script>
@endsection
