@extends('backend.layouts.error')

@section('title', '500 Error')

@section('css')
@endsection

@section('content')
    <!-- page content -->
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">500</h1>
                <h2>Error Interno del Servidor</h2>
                <p>Se ha guardado este error en una traza, mientras, desea ir al <a href="{{url('/admin')}}">Dashboard</a>?
                </p>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('js')

@endsection
