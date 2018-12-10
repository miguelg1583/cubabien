@extends('backend.layouts.master')

@section('title', 'Imágenes - Galeria')
@section('css')
    <link href="{{assets_file('vendor/gallery/css/blueimp-gallery.min.css')}}" rel="stylesheet">
    <style>
        .blueimp-gallery > .boton-borrar {
            position: absolute;
            top: 60px;
            left: 15px;
            color: #fff;
            display: none;
        }

        .blueimp-gallery-controls > .boton-borrar {
            display: block;
        }
    </style>
@endsection

@section('title_content', 'Imágenes')

@section('content')
    {{--<div id="app" v-cloak>--}}
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-file-image-o"></i> Galeria
                <small>de click para ver en grande</small>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="lightBoxGallery" id="links">
                @foreach($imagenes as $imagen)
                    <a class="link-imagenes" href="{{assets_file('frontend/images/thumbs/1360x768/'.$imagen)}}"
                       data-gallery=""
                       title="{!! $imagen !!}" data-nombre="{!! $imagen !!}"><img
                                src="{{assets_file('frontend/images/thumbs/100x100/'.$imagen)}}"
                                alt="{!! $imagen !!}"></a>
                @endforeach
            </div>
            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <div class="boton-borrar">
                    <button data-id="" id="btn-eliminar" class="btn btn-round btn-danger delete-modal">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </div>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>

            {{--</div>--}}
        </div>
    </div>
    {{--</div>--}}
@endsection

@section('js')
    <script src="{{assets_file('vendor/gallery/js/jquery.blueimp-gallery.min.js')}}"></script>
    <script type="text/javascript">


        $('#blueimp-gallery').on('slide', function (event, index, slide) {
            let nombre = $($('.link-imagenes')[index]).data('nombre');
            $('#btn-eliminar').data('id', nombre);
        });

        $('#btn-eliminar').on('click', function () {
            let nb_img = $(this).data('id');
            $.post({
                url: '{{route('imagen.destroy')}}',
                data: {id: nb_img, _token: $('[name="_token"]').val()},
                dataType: 'json',
                success: function (data) {
                    App.showNotiSuccess('Archivo Eliminado satisfactoriamente!!');
                },
                error: function (data) {
                    App.showNotiError('Ocurrió un error en el Servidor, intente nuevamente')
                }
            });
        });

    </script>
@endsection
