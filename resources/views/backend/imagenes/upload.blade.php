@extends('backend.layouts.master')

@section('title', 'Imágenes - Subir')

@section('css')
    <link href="{{assets_file('vendor/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
@endsection

@section('title_content', 'Imágenes')

@section('page-title')
    {{--<div class="title_right">--}}
        {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">--}}
            {{--<div class="progress progress_sm">--}}
                {{--<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57" aria-valuenow="56"--}}
                     {{--style="width: {!! bcround(($free/$total)*100)!!}%;"></div>--}}
            {{--</div>--}}
            {{--<small>{{humanizaCapacidad($free)}} libre de un total de {{humanizaCapacidad($total)}}</small>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('content')
    {{--<div id="app" v-cloak>--}}

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-file-code-o"></i> Subir
                <small>al servidor</small>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <p>Arrastre y suelte varias imágenes en el contenedor de abajo para subir varias imágenes o de clic para
                seleccionar imágenes.</p>
            <form action="{{route('imagen.store')}}" method="POST" enctype="multipart/form-data" class="dropzone"
                  id="form-upload-image">
                {{csrf_field()}}
            </form>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
    {{--</div>--}}
@endsection

@section('js')
    <script src="{{assets_file('vendor/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        // $(document).ready(() => {
        //     App.initAjax();
        // });
        Dropzone.options.formUploadImage = {
            uploadMultiple: false,
            parallelUploads: 2,
            // maxFilesize: 16,
            // previewTemplate: document.querySelector('#preview').innerHTML,
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar Imagen',
            dictCancelUpload: 'Cancelar Subida',
            dictDefaultMessage: 'Arrastre archivos aquí para Subir',
            acceptedFiles: 'image/jpeg, image/gif, image/png',
            // dictFileTooBig: 'Image is larger than 16MB',
            // timeout: 10000,

            init: function () {
                this.on("removedfile", function (file) {
                    $.post({
                        url: '{{route('imagen.destroy')}}',
                        data: {id: file.name, _token: $('[name="_token"]').val()},
                        dataType: 'json',
                        success: function (data) {
                            App.showNotiSuccess('Archivo Eliminado satisfactoriamente!!');
                        },
                        error: function (data) {
                            App.showNotiError('Ocurrió un error en el Servidor, intente nuevamente')
                        }
                    });
                });
                this.on('error', function (file, response) {
                    console.log('IndexOf',file.type.indexOf('image/'));
                    if (file.type.indexOf('image/') === -1) {
                        $(file.previewElement).find('.dz-error-message').text('Solo puede subir imágenes');
                    } else {
                        $(file.previewElement).find('.dz-error-message').text('Ocurrió un error');
                    }
                    App.showNotiError('Ocurrió un error, intente nuevamente');
                    console.log('File', file);
                    console.log('Response', response);
                });
                // console.log('Init Function');
            },
            success: function (file, done) {
                // total_photos_counter++;
                // $("#counter").text("# " + total_photos_counter);
                // console.log('Success Function');
                App.showNotiSuccess('Imagen Subida satisfactoriamente!!');
            }
        };
    </script>
@endsection
