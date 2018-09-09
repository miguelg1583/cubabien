@extends('backend.layouts.master')

@section('title', 'Traducciones')

@section('css')
@endsection

@section('title_content', 'Traducciones')

@section('content')
    <div id="app" v-cloak>
        @include('backend.layouts.delete_modal')
        @include('backend.layouts.show_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Listado
                    <small>tabs por idiomas</small>
                </h2>
                <a href="{{route('traduccion.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel">
                    <ul id="tradTab" class="nav nav-tabs bar_tabs" role="tablist">

                        <li role="presentation" v-for="(val, index) in idiomas" :class="{ 'active': index==0 }"><a
                                    :href="'#tab_'+val.sigla" :id="val.sigla+'-tab'" role="tab"
                                    data-toggle="tab" :aria-expanded="index==0 ? 'true' : 'false'">@{{ val.nombre }}</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" v-for="(val, index) in idiomas"
                             :class="{'tab-pane': true, 'fade': true, 'active': index==0, in: index==0}"
                             :id="'tab_'+val.sigla"
                             :aria-labelledby="val.sigla+'-tab'">
                            <table :id="'DTC_trad_'+val.sigla"
                                   class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                                <thead>
                                <tr>
                                    {{--<th>id</th>--}}
                                    <th>Grupo</th>
                                    <th>Llave</th>
                                    <th>Valor</th>
                                    <th>Creado</th>
                                    <th>Modificado</th>
                                    <th>Operaciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(trad,pos) in traducciones">
                                    <td>@{{ trad.group }}</td>
                                    <td>@{{ trad.key }}</td>
                                    <td>
                                        @{{String(trad.text[val.sigla]).length<30?trad.text[val.sigla]:trad.text[val.sigla].substring(0,30)+'(...)'
                                        }}
                                    </td>
                                    <td>@{{ getMomentFormat(trad.created_at) }}</td>
                                    {{--<td>@{{ createdMoment(pos) }}</td>--}}
                                    <td>@{{ getMomentFormat(trad.updated_at) }}</td>
                                    <td>
                                        <button class="btn btn-round btn-success"
                                                v-on:click.prevent="showTradu(trad, val.sigla)">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                        <a :href="'{!! url('/admin/traduccion') !!}/'+trad.id+'/edit'"
                                           class="btn btn-round btn-info" :data-id="trad.id">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <button class="btn btn-round btn-danger delete-modal"
                                                data-toggle="modal" data-target="#deleteModal" :data-id="trad.id"
                                                :data-index="pos">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    {{--<th>id</th>--}}
                                    <th>Grupo</th>
                                    <th>Llave</th>
                                    <th>Valor</th>
                                    <th>Creado</th>
                                    <th>Modificado</th>
                                    <th>Operaciones</th>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection

@section('js')
    <script type="text/javascript">
        window.vmContext = new Vue({
            el: "#app",
            data: {
                id: "",   //ponerlo en todos los vue de listado
                idiomas: {!! json_encode($idiomas) !!},
                traducciones: {!! json_encode($traducciones) !!},
            },
            methods: {
                getMomentFormat: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').format("dddd, DD/MM/YYYY h:mm a");
                },
                showTradu: function (trad, sigla) {
                    console.log('entro');
                    let contenido = "<div>" +
                        "<div class='row'>" +
                        "<div class='col-md-3'><b>Grupo:</b></div>" +
                        "<div class='col-md-9'><p>" + trad.group + "</p></div>" +
                        "</div>" +
                        "<div class='row'>" +
                        "<div class='col-md-3'><b>Llave:</b></div>" +
                        "<div class='col-md-9'><p>" + trad.key + "</p></div>" +
                        "</div>" +
                        "<div class='row'>" +
                        "<div class='col-md-3'><b>Valor:</b></div>" +
                        "<div class='col-md-9'><p>" + trad.text[sigla] + "</p></div>" +
                        "</div>" +
                        "</div>";
                    $("#show_modal_content").html(contenido);
                    $("#showModal").modal("show");
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

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
        });

        //delete
        let id = '';
        let indexTrad = '';
        $(document).on("click", ".delete-modal", function () {
            id = $(this).data("id");
            indexTrad = $(this).data("index");
        });
        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/traduccion') !!}');
            vmContext.traducciones.splice(indexTrad, 1);
            $("table[id^=DT]").each(function () {
                $(this).DataTable().row(indexTrad).remove().draw()
            });
        });


    </script>
@endsection
