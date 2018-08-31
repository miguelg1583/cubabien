@extends('backend.layouts.error')

@section('title', '404 Error')

@section('css')
@endsection

@section('content')
    <!-- page content -->
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">404</h1>
                <h2>Lo Siento, pero no podemos encontrar esta página</h2>
                <p>La página que esta buscando no existe. Desea ir al <a href="{{url('/admin')}}">Dashboard</a>?
                </p>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('js')

@endsection
