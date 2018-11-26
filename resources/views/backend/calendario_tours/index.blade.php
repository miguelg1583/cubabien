@extends('backend.layouts.master')

@section('title', 'Calendarios')

@section('css')
    <link href="{{assets_file('vendor/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{assets_file('vendor/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">
    <style>
        /*.fc-event {*/
        /*height: 25px !important;*/
        /*}*/
    </style>
@endsection

@section('title_content', 'Calendarios y Precios de los Tours')

@section('content')
    @include('backend.layouts.delete_modal')
    @include('backend.layouts.show_modal')
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bars"></i> Fechas</h2>
            <a href="{{route('calendario-tour.create')}}" class="navbar-right btn btn-round btn-success">Agregar</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{assets_file('vendor/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{assets_file('vendor/fullcalendar/dist/locale/es.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(init_calendar());

        function render_calendar() {
            $('#calendar').fullCalendar('refetchEvents');
            console.log('renderizado');
        }

        function init_calendar() {
            App.initAjax();

            $('#calendar').fullCalendar('destroy')
                .fullCalendar({
                    header: {
                        center: 'title',
                        left: 'prev, next today',
                        right: ''
                    },
                    views: {
                        month: { // name of view
                            titleFormat: 'MMMM, YYYY'
                            // other view-specific options here
                        }
                    },
                    // selectable: true,
                    editable: true,
                    locale: 'es',
                    themeSystem: 'bootstrap3',
                    defaultView: 'month',
                    fixedWeekCount: false,
                    height: 'auto',
                    // allDayDefault: true,
                    events: {
                        url: '{{route('calendario-tour.calendar')}}',
                        type: 'POST',
                    },
                    eventRender: function (event, element) {
                        element.css("font-size", "1em");
                        element.css("padding", "3px");
                    },
                    // select: function (start, end, jsEvent) {
                    //     alert('Inicio: ' + start.format('DD-MM-YYYY') + 'Fin: ' + end.subtract(1, 'days').format('DD-MM-YYYY'));
                    //     console.log(jsEvent);
                    // },
                    eventClick: function (calEvent, jsEvent, view) {
                        let footer_html = '<a href="{{url('/admin/calendario-tour')}}/'+calEvent.id+'/edit" class="btn btn-info" data-id="'+calEvent.id+'"><span class="glyphicon glyphicon-edit"></span> Editar</a>';
                        footer_html += '<button type="button" class="btn btn-danger delete-modal" data-dismiss="modal" data-toggle="modal" data-target="#deleteModal" data-id="'+calEvent.id+'"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>';
                        footer_html += '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                        $.ajax({
                            type: 'POST',
                            url: '{{route('calendario-tour.getCalendar')}}',
                            data: {
                                'id': calEvent.id,
                            }
                        }).done(function (data) {
                            if (data.errors) {
                                console.log(data);
                                App.showNotiError('Ha ocurrido un problema en el servidor');
                            } else {
                                $("#show_modal_content").html(data);
                                $("#show_footer").html(footer_html);

                                $("#showModal").modal("show");
                            }
                        });
                    }
                })
        }

        let id = '';
        $(document).on("click", ".delete-modal", function () {
            id=$(this).data("id");
        });

        $(".modal-footer").on("click", ".delete", function () {
            App.AjaxDel(id, '{!! url('/admin/calendario-tour') !!}').done(function () {
                render_calendar();
            });
        });
    </script>
@endsection
