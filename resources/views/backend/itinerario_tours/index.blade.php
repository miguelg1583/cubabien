@extends('backend.layouts.master')

@section('title', 'Itinerarios')

@section('css')
@endsection

@section('title_content', 'Itinerarios de los Tours')

@section('content')

    @include('backend.layouts.delete_modal')
    @include('backend.layouts.show_modal')
    <a href="{{route('itinerario-tour.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
    <div class="clearfix"></div>
    <div id="app" v-cloak>
        <div class="col-md-6 col-sm-6 col-xs-12" v-for="(tour,pos) in tours">
            <div class="x_panel">
                <div class="x_title">
                    <h2>@{{ tour.nb }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="list-unstyled timeline">
                        <li v-for="(itine, pos_itine) in tour.itinerario">
                            <div class="block">
                                <div class="tags">
                                    <a href="javascript:void;" class="tag">
                                        <span>Día @{{ itine.dia }}</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    {{--<h2 class="title">--}}
                                    {{--<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>--}}
                                    {{--</h2>--}}
                                    <div class="byline">
                                        <span>@{{getMomentDiffHuman(itine.created_at)}}</span>
                                    </div>
                                    <div class="excerpt" v-html="itine.contenido"></div>
                                </div>
                            </div>
                        </li>
                        {{--<li>--}}
                        {{--<div class="block">--}}
                        {{--<div class="tags">--}}
                        {{--<a href="" class="tag">--}}
                        {{--<span>Entertainment</span>--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="block_content">--}}
                        {{--<h2 class="title">--}}
                        {{--<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>--}}
                        {{--</h2>--}}
                        {{--<div class="byline">--}}
                        {{--<span>13 hours ago</span> by <a>Jane Smith</a>--}}
                        {{--</div>--}}
                        {{--<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>--}}
                        {{--</p>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<div class="block">--}}
                        {{--<div class="tags">--}}
                        {{--<a href="" class="tag">--}}
                        {{--<span>Entertainment</span>--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="block_content">--}}
                        {{--<h2 class="title">--}}
                        {{--<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>--}}
                        {{--</h2>--}}
                        {{--<div class="byline">--}}
                        {{--<span>13 hours ago</span> by <a>Jane Smith</a>--}}
                        {{--</div>--}}
                        {{--<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>--}}
                        {{--</p>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</li>--}}
                    </ul>
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
                tours: {!! json_encode($tours) !!},
                {{--itinerarios: {!! json_encode($itinerarios) !!},--}}
            },
            methods: {
                getMomentFormat: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').format("dddd, DD/MM/YYYY h:mm a");
                },
                getMomentDiffHuman: function (fecha) {
                    return moment(fecha, 'YYYY-MM-DD HH:mm:ss').fromNow();
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
            App.AjaxDel(id, '{!! url('/admin/itinerario-tour') !!}');
            vmContext.itinerarios.splice(indexPreg, 1);
            $('#itinerario_tour_DTG').DataTable().row(indexPreg).remove().draw(true);
        });
    </script>
@endsection
