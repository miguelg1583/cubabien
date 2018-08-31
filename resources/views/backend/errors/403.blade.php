@extends('backend.layouts.error')

@section('title', '403 Error')

@section('css')
@endsection

@section('content')
    <!-- page content -->
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">403</h1>
                <h2>Accesso Denegado</h2>
                <p>Autenticación completa necesaria para acceder a esta página. Desea ir al <a href="{{url('/')}}">sitio
                        público</a>?
                </p>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('js')

@endsection
