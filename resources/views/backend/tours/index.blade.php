@extends('backend.layouts.master')

@section('title', 'Tours')

@section('css')
@endsection

@section('title_content', 'Tours')

@section('content')
    <div id="app" v-cloak>
        @include('backend.layouts.delete_modal')
        @include('backend.layouts.show_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Listado
                    {{--<small>tabs por idiomas</small>--}}
                </h2>
                <a href="{{route('tour.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="DTC_tours" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Traduccion</th>
                        <th>Activo</th>
                        <th>Introduccion</th>
                        <th>Traduccion</th>
                        <th>Días</th>
                        <th>Noches</th>
                        <th>Salida</th>
                        <th>Llegada</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(tour,pos) in tours">
                        <td>@{{ tour.nb }}</td>
                        <td><a v-on:click.stop.prevent="showTradu(tour.nb_trad)" class="show_modal_table">@{{
                                tour.nb_trad }}</a></td>
                        <td><input type="checkbox" class="btog-activo" :id="'check'+tour.id" :data-id="tour.id"
                                   :checked="(tour.activo == 1)"></td>
                        <td><a v-on:click.stop.prevent="showData(tour.id,'introd')" class="show_modal_table">@{{
                                tour.introd.length < 30 ? tour.introd : tour.introd.substring(0,30) + '(...)' }}</a>
                        </td>
                        <td><a v-on:click.stop.prevent="showTradu(tour.introd_trad)" class="show_modal_table">@{{
                                tour.introd_trad }}</a></td>
                        <td>@{{ tour.num_dias }}</td>
                        <td>@{{ tour.num_noches }}</td>
                        <td>@{{ capitalize(getMomentIsoWeek(tour.salida_dia_trad)) }}</td>
                        <td>@{{ capitalize(getMomentIsoWeek(tour.llegada_dia_trad)) }}</td>
                        <td>@{{ getMomentFormat(tour.created_at) }}</td>
                        <td>@{{ getMomentFormat(tour.updated_at) }}</td>
                        <td>
                            <a :href="'{!! url('/admin/tour') !!}/'+tour.id+'/edit'"
                               class="btn btn-round btn-info" :data-id="tour.id">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <button class="btn btn-round btn-danger delete-modal"
                                    data-toggle="modal" data-target="#deleteModal" :data-id="tour.id"
                                    :data-index="pos">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Traduccion</th>
                        <th>Introduccion</th>
                        <th>Traduccion</th>
                        <th>Días</th>
                        <th>Noches</th>
                        <th>Salida</th>
                        <th>Llegada</th>
                        <th>Activo</th>
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
                tours: {!! json_encode($tours) !!},
            },
            methods: {
                getMomentFormat: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').format("dddd, DD/MM/YYYY h:mm a");
                },
                getMomentIsoWeek: function (dia) {
                    return moment().isoWeekday(dia).format('dddd');
                },
                capitalize: function (s) {
                    if (typeof s !== 'string') return '';
                    return s.charAt(0).toUpperCase() + s.slice(1)
                },
                initDatatable: function () {
                    $('#DTC_tours').DataTable({
                        'paging': true,
                        'responsive': true,
                        // 'scrollX': true,
                        'lengthMenu': [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                        'lengthChange': true,
                        'searching': true,
                        'ordering': true,
                        'info': true,
                        'autoWidth': true,
                        'language': {
                            'url': "{{config('app.url')}}" + '/backend/js/Spanish.json'
                        },
                        // order: [[0, 'asc']],
                        // rowGroup: {
                        //     dataSrc: 0
                        // },
                        // columnDefs: [{targets: 0, visible: false}],

                        // 'drawCallback': function (settings) {
                        //     console.log('btoggle');
                        //     $("input[id^=check]").each(function () {
                        //         $(this).bootstrapToggle({
                        //             on: 'Si',
                        //             off: 'No',
                        //             onstyle: 'success',
                        //             offstyle: 'danger',
                        //             size: 'mini'
                        //         });
                        //     });
                        // },

                        // 'rowCallback': function (row, data) {
                        //     // console.log('funcion rowCallback row', row);
                        //     // console.log('funcion rowCallback data', data.id);
                        //     $(row).find('input[id^="check"]').bootstrapToggle({
                        //         on: 'Si',
                        //         off: 'No',
                        //         onstyle: 'success',
                        //         offstyle: 'danger',
                        //         size: 'mini'
                        //     });
                        //     // console.log('esta el ', data.id, data.uid);
                        // }
                    });

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
                        url: '{!! route('getDatosTour') !!}',
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
                activaBtoggle: function () {
                    $('input[id^="check"]').bootstrapToggle({
                        on: 'Si',
                        off: 'No',
                        onstyle: 'success',
                        offstyle: 'danger',
                        size: 'mini'
                    });
                }
            },
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initAjax();
            },
            mounted: function () {
                // App.initDatatable();
                this.initDatatable();
                this.activaBtoggle()
            },

        });


        //delete
        let id = '';
        let indexTrad = '';
        $(document).on("click", ".delete-modal", function () {
            id = $(this).data("id");
            indexTrad = $(this).data("index");
        });
        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/tour') !!}').done(function () {
                vmContext.tours.splice(indexTrad, 1);
                $('#DTC_tours').DataTable().row(indexTrad).remove().draw();
            });
        });


        //activar o desactivar
        // $('#DTC_tours').find('tbody').on('click', 'tr', function () {
        //     $(this).find(".btog-activo").change(function () {
        $(".btog-activo").change(function () {
            id = $(this).data("id");
            valor = this.checked;
            // console.log(valor);
            $.ajax({
                type: 'PUT',
                url: '/admin/tour/activo/' + id,
                data: {
                    'id': id,
                    'valor': valor
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
        // });
    </script>
@endsection
