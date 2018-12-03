@extends('backend.layouts.master')

@section('title', 'Imágenes - Galeria')
@section('css')
    <link href="{{assets_file('vendor/gallery/css/blueimp-gallery.min.css')}}" rel="stylesheet">
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
            <div class="lightBoxGallery">
                @foreach($imagenes as $imagen)
                    <a href="{{getImageThumbnail($imagen,1360,768, 'fit')}}" data-gallery=""><img src="{{getImageThumbnail($imagen,100,100, 'fit')}}"></a>
                @endforeach
            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                <div id="blueimp-gallery" class="blueimp-gallery">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>

            </div>
        </div>
    </div>
    {{--</div>--}}
@endsection

@section('js')
    <script src="{{assets_file('vendor/gallery/js/jquery.blueimp-gallery.min.js')}}"></script>
    <script type="text/javascript">

    </script>
@endsection
