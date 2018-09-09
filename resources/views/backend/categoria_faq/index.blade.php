@extends('backend.layouts.master')

@section('title', 'Categorias')

@section('css')
@endsection

@section('title_content', 'Categorias')

@section('content')
    <div id="app" v-cloak>
        @include('backend.layouts.delete_modal')
        @include('backend.layouts.show_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Listado
                    {{--<small>tabs por idiomas</small>--}}
                </h2>
                <a href="{{route('categoria-faq.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="DTC_categorias" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Nombre</th>
                        <th>Traduccion</th>
                        <th>Visitas</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(categ,pos) in categorias">
                        <td>@{{ categ.nb }}</td>
                        <td><a v-on:click.stop.prevent="showTradu(categ.nb_trad)" class="show_modal_table">@{{
                                categ.nb_trad }}</a></td>
                        <td>@{{ categ.visitas }}</td>
                        <td>@{{ getMomentFormat(categ.created_at) }}</td>
                        <td>@{{ getMomentFormat(categ.updated_at) }}</td>
                        <td>
                            <a :href="'{!! url('/admin/categoria-faq') !!}/'+categ.id+'/edit'"
                               class="btn btn-round btn-info" :data-id="categ.id">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <button class="btn btn-round btn-danger delete-modal"
                                    data-toggle="modal" data-target="#deleteModal" :data-id="categ.id"
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
                        <th>Visitas</th>
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
                categorias: {!! json_encode($categorias) !!},
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
            },
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initAjax();
            },
            mounted: function () {
                App.initDatatable();
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
            App.AjaxDel(id, '{!! url('/admin/categoria-faq') !!}');
            vmContext.categorias.splice(indexTrad, 1);
            $('#DTC_categorias').DataTable().row(indexTrad).remove().draw();
        });
    </script>
@endsection
