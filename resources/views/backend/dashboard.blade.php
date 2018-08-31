@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('title_content', 'Dashboard')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Plain Page</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <ul>
                <li>Una row con mapa del mundo y numero de visitas</li>
                <li>Grafico de linea con # de veces que se ha entrado</li>
                <li>Una columna por tipo de servicio con grafico de lo mas visto</li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
@endsection

@section('js')
@endsection
