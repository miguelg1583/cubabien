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
            l
        </div>
    </div>
@endsection

@section('js')
    <script src="{{assets_file('vendor/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{assets_file('vendor/fullcalendar/dist/locale/es.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(init_calendar());

        function render_calendar() {
            $('#calendar').fullCalendar('render');
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
                    selectable: true,
                    editable: true,
                    locale: 'es',
                    themeSystem: 'bootstrap3',
                    defaultView: 'month',
                    fixedWeekCount: false,
                    height: 'auto',
                    allDayDefault: true,
                    events: {
                        url: '{{route('calendario-tour.calendar')}}',
                        type: 'POST',
                    },
                    eventRender: function (event, element) {
                        element.css("font-size", "1em");
                        element.css("padding", "3px");
                    },
                    select: function (start, end, jsEvent) {
                        alert('Inicio: ' + start.format('DD-MM-YYYY') + 'Fin: ' + end.subtract(1, 'days').format('DD-MM-YYYY'));
                        console.log(jsEvent);
                    },
                    eventClick: function (calEvent, jsEvent, view) {

                        alert('Event: ' + calEvent.title + 'Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY + 'View: ' + view.name);
                        console.log(calEvent.objeto);
                        $('#showModal').modal('show');
                        // change the border color just for fun
                        $(this).css('border-color', 'red');

                    }
                    {{--events: function (start, end, timezone, callback) {--}}
                    {{--console.log(start.format('DD-MM-YYYY'));--}}
                    {{--console.log(end.format('DD-MM-YYYY'));--}}
                    {{--$.ajax({--}}
                    {{--url: '{{route('calendario-tour.calendar')}}',--}}
                    {{--type: 'POST',--}}
                    {{--data: {--}}
                    {{--start: start,--}}
                    {{--end: end,--}}
                    {{--},--}}
                    {{--// success: function (doc) {--}}
                    {{--//     var events = [];--}}
                    {{--//     $(doc).find('event').each(function () {--}}
                    {{--//         events.push({--}}
                    {{--//             title: $(this).attr('title'),--}}
                    {{--//             start: $(this).attr('start') // will be parsed--}}
                    {{--//         });--}}
                    {{--//     });--}}
                    {{--//     callback(events);--}}
                    {{--// }--}}
                    {{--});--}}
                    {{--}--}}
                })
        }
    </script>
@endsection
