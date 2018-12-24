@extends('backend.layouts.master')

@section('title', 'Itinerarios')

@section('css')
@endsection

@section('title_content', 'Itinerarios de los Tours')

@section('content')
    <div id="app" v-cloak>
        @include('backend.layouts.delete_modal')
        @include('backend.layouts.show_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Listado
                    <small>links para mostrar las traducciones</small>
                </h2>
                <a href="{{route('itinerario-tour.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="itinerario_tour_DTG" class="table table-striped table-bordered dt-responsive nowrap"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Tour</th>
                        <th>Día</th>
                        <th>Contenido</th>
                        <th>Traduccion</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(itine_tour,pos) in itinerarios">
                        <td>@{{ itine_tour.tour.nb }}</td>
                        <td>@{{ itine_tour.dia }}</td>
                        <td><a v-on:click.stop.prevent="showData(itine_tour.id,'contenido')" class="show_modal_table">@{{String(itine_tour.contenido).length<30?itine_tour.contenido:itine_tour.contenido.substring(0,30)+' (...)'}}</a></td>
                        <td><a v-on:click.stop.prevent="showTradu(itine_tour.contenido_trad)" class="show_modal_table">@{{
                                itine_tour.contenido_trad }}</a></td>
                        <td>@{{ getMomentFormat(itine_tour.created_at) }}</td>
                        <td>@{{ getMomentFormat(itine_tour.updated_at) }}</td>
                        <td>
                            <a :href="'{!! url('/admin/itinerario-tour') !!}/'+itine_tour.id+'/edit'"
                               class="btn btn-round btn-info" :data-id="itine_tour.id">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <button class="btn btn-round btn-danger delete-modal"
                                    data-toggle="modal" data-target="#deleteModal" :data-id="itine_tour.id"
                                    :data-index="pos">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Tour</th>
                        <th>Día</th>
                        <th>Contenido</th>
                        <th>Traduccion</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th>Operaciones</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script type="text/javascript">
        window.vmContext = new Vue({
            el: "#app",
            data: {
                idiomas: {!! json_encode($idiomas) !!},
                itinerarios: {!! json_encode($itinerarios) !!},
            },
            methods: {
                getMomentFormat: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').format("dddd, DD/MM/YYYY h:mm a");
                },
                showTradu: function (trad_string) {
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('getTrad') !!}',
                        data: {
                            'trad': trad_string,
                        },
                        success: function (data) {
                            if (data.errors) {
                                console.log(data);
                                App.showNotiError('Ha ocurrido un problema en el servidor');
                            } else {
                                $("#show_modal_content").html(data);
                                $("#showModal").modal("show");
                            }
                        },
                    });
                },
                showData: function (id, dato) {
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('getDatosItinerarioTour') !!}',
                        data: {
                            'id': id,
                            'dato': dato
                        },
                        success: function (data) {
                            if (data.errors) {
                                console.log(data);
                                App.showNotiError('Ha ocurrido un problema en el servidor');
                            } else {
                                $("#show_modal_content").html(data);
                                $("#showModal").modal("show");
                            }
                        },
                    });
                },
                initDatatableGroup: function () {
                    $('#itinerario_tour_DTG').DataTable({
                        'paging': true,
                        'responsive': true,
                        'lengthMenu': [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                        'lengthChange': true,
                        'searching': true,
                        'ordering': true,
                        'info': true,
                        'autoWidth': true,
                        'language': {
                            'url': "{{config('app.url')}}" + '/backend/js/Spanish.json'
                        },
                        order: [[0, 'asc']],
                        rowGroup: {
                            dataSrc: 0
                        },
                        columnDefs: [{targets: 0, visible: false}],
                    });
                }

            },
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initAjax();
            },
            mounted: function () {
                // App.initDatatable();
                this.initDatatableGroup();
            },

        });


        //delete
        let id = '';
        let indexPreg = '';
        $(document).on("click", ".delete-modal", function () {
            id = $(this).data("id");
            indexPreg = $(this).data("index");
        });
        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/itinerario-tour') !!}').done(function (data) {
                if(data.mensaje === 'OK'){
                    vmContext.itinerarios.splice(indexPreg, 1);
                    $('#itinerario_tour_DTG').DataTable().row(indexPreg).remove().draw(true);
                }
            });
        });
    </script>
@endsection
