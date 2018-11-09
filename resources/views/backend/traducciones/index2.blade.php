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
                            <table :id="'DTS_trad_'+val.sigla"
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
                idiomas: {!! json_encode($idiomas) !!},
            },
            methods: {
                getMomentFormat: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').format("dddd, DD/MM/YYYY h:mm a");
                },
                // showTradu: function (trad, sigla) {
                //     console.log('entro');
                //     let contenido = "<div>" +
                //         "<div class='row'>" +
                //         "<div class='col-md-3'><b>Grupo:</b></div>" +
                //         "<div class='col-md-9'><p>" + trad.group + "</p></div>" +
                //         "</div>" +
                //         "<div class='row'>" +
                //         "<div class='col-md-3'><b>Llave:</b></div>" +
                //         "<div class='col-md-9'><p>" + trad.key + "</p></div>" +
                //         "</div>" +
                //         "<div class='row'>" +
                //         "<div class='col-md-3'><b>Valor:</b></div>" +
                //         "<div class='col-md-9'><p>" + trad.text[sigla] + "</p></div>" +
                //         "</div>" +
                //         "</div>";
                //     $("#show_modal_content").html(contenido);
                //     $("#showModal").modal("show");
                // },
                getDataTables: function () {
                    console.log(this.idiomas);
                    this.idiomas.forEach(function (idioma) {
                        console.log(idioma.sigla);
                        $('#DTS_trad_'+idioma.sigla).DataTable({
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
                                url: "{!! route('trad.list') !!}",
                                type: "POST",
                                data: {"idioma": idioma.sigla}
                            },

                            columns: [
                                // {data: 'id'},
                                {data: 'group'},
                                {data: 'key'},
                                {data: 'text', orderable: false},
                                {data: 'created_at'},
                                {data: 'updated_at'},
                                {data: 'operaciones'}
                            ],
                            // columnDefs: [{targets: 0, visible: false}],
                        });
                    });
                }
            },
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initAjax();
            },
            mounted: function () {
                // App.initDatatable();
                this.getDataTables();
            }
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
        });

        //delete
        let id = '';
        $(document).on("click", ".delete-modal", function () {
            id = $(this).data("id");
        });
        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/traduccion') !!}').done(()=>{
                $("table[id^=DT]").each(function () {
                    $(this).DataTable().ajax.reload();
                });
            });

            // $("table[id^=DT]").each(function () {
            //     $(this).DataTable().ajax.reload();
            // });
        });

        //show
        $(document).on("click", ".show-modal", function () {
            $.ajax({
                type: 'GET',
                url: '{!! url('/admin/traduccion') !!}/'+$(this).data("id"),
                // data: {
                //     'trad': trad_string,
                // },
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
        });



    </script>
@endsection
