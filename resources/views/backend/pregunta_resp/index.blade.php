@extends('backend.layouts.master')

@section('title', 'Preguntas y Respuestas')

@section('css')
@endsection

@section('title_content', 'Preguntas y Respuestas')

@section('content')
    <div id="app" v-cloak>
        @include('backend.layouts.delete_modal')
        @include('backend.layouts.show_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Listado
                    <small>links para mostrar las traducciones</small>
                </h2>
                <a href="{{route('pregunta-resp.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="DTC_preguntas_resp" class="table table-striped table-bordered dt-responsive nowrap"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Categoria</th>
                        <th>Pregunta</th>
                        <th>Traduccion</th>
                        <th>Respuesta</th>
                        <th>Traduccion</th>
                        <th>Visitas</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(preg_resp,pos) in preguntas_resps">
                        <td>@{{ preg_resp.categoria_faq.nb }}</td>
                        <td><a v-on:click.stop.prevent="showData(preg_resp.id,'pregunta')" class="show_modal_table">@{{preg_resp.pregunta.length<30?preg_resp.pregunta:preg_resp.pregunta.substring(0,30)+' (...)'}}</a></td>
                        <td><a v-on:click.stop.prevent="showTradu(preg_resp.pregunta_trad)" class="show_modal_table">@{{
                                preg_resp.pregunta_trad }}</a></td>
                        <td><a v-on:click.stop.prevent="showData(preg_resp.id,'respuesta')" class="show_modal_table">@{{String(preg_resp.respuesta).length<30?preg_resp.respuesta:preg_resp.respuesta.substring(0,30)+' (...)'}}</a></td>
                        <td><a v-on:click.stop.prevent="showTradu(preg_resp.respuesta_trad)" class="show_modal_table">@{{
                                preg_resp.respuesta_trad }}</a></td>
                        <td>@{{ preg_resp.visitas }}</td>
                        <td>@{{ getMomentFormat(preg_resp.created_at) }}</td>
                        <td>@{{ getMomentFormat(preg_resp.updated_at) }}</td>
                        <td>
                            <a :href="'{!! url('/admin/pregunta-resp') !!}/'+preg_resp.id+'/edit'"
                               class="btn btn-round btn-info" :data-id="preg_resp.id">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <button class="btn btn-round btn-danger delete-modal"
                                    data-toggle="modal" data-target="#deleteModal" :data-id="preg_resp.id"
                                    :data-index="pos">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>id</th>--}}
                        <th>Categoria</th>
                        <th>Pregunta</th>
                        <th>Traduccion</th>
                        <th>Respuesta</th>
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
                preguntas_resps: {!! json_encode($preguntas_resps) !!},
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
                        url: '{!! route('getDatosPregResp') !!}',
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
        let indexPreg = '';
        $(document).on("click", ".delete-modal", function () {
            id = $(this).data("id");
            indexPreg = $(this).data("index");
        });
        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/pregunta-resp') !!}');
            vmContext.preguntas_resps.splice(indexPreg, 1);
            $('#DTC_preguntas_resp').DataTable().row(indexPreg).remove().draw(true);
        });
    </script>
@endsection
