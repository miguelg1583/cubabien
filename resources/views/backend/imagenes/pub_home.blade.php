@extends('backend.layouts.master')

@section('title', 'Imágenes - Publicar')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/select2/css/select2.min.css')}}"/>
@endsection

@section('title_content', 'Imágenes')

@section('page-title')
@endsection

@section('content')
    <div id="app" v-cloak>

        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-file-code-o"></i> Publicar
                    <small>imágenes de la página de inicio</small>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">
                    <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('imagen.imagen')}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="imagen">Imagen </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select2 id="imagen" class="form-control col-md-7 col-xs-12"
                                     name="imagen"
                                     v-model="imagen"
                                     :options="imagenes_files"
                                     :allowclear="true">
                            </select2>
                        </div>
                        <button class="btn btn-round btn-success"
                                v-on:click.prevent="actionAddElement()"
                                :disabled="addNoValido()">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-sm-offset-4 col-md-offset-4">
                        <img :src="imagen_encode" class="img-responsive" alt="itinerario.imagen">
                    </div>
                </form>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-2">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Operación</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(img, pos_img) in imagenes_db">
                                <td>@{{ img.imagen }}</td>
                                <td><a href="javascript:;" class="label label-danger"
                                       v-on:click.prevent="quitaDeArreglo('imagenes_db', pos_img)"><span
                                                class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-xs-12 col-sm-offset-3 col-md-offset-3">
                        <div id="homeCarousel" class="carousel slide" data-ride="carousel" style="width: 600px; height: 440px;">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li v-for="(img, pos_img) in imagenes_db" data-target="#homeCarousel"
                                    :data-slide-to="pos_img" :class="{'active':pos_img==0}"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div v-for="(img, pos_img) in imagenes_db" :class="{'item':true, 'active':pos_img==0}">
                                    <img :src="img.encode" :alt="img.imagen">
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#homeCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#homeCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" :disabled="isNoValido"
                                v-on:click.prevent="publicar()"><span
                                    class='fa fa-check'></span>Publicar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{assets_file('vendor/select2/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
        Vue.use(VeeValidate, {locale: 'es'});
        window.vmContext = new Vue({
            el: "#app",
            beforeCreate() {
                App.init("{{config('app.url')}}");
            },
            created() {
                App.initAjax();
            },
            data: {
                imagenes_db: {!! json_encode($images_db) !!},
                imagenes_files: {!! json_encode($images_files) !!},
                imagen: '',
                imagen_encode: '',
            },
            computed: {
                isNoValido() {
                    return this.imagenes_db.length < 1;
                },
            },
            watch: {
                'imagen': function (despues, antes) {
                    let self = this;
                    if (despues === '') {
                        self.imagen_encode = '';
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '{!! route('imagen.encode') !!}',
                            data: {
                                'imagen': despues,
                                'width': 300,
                                'height': 200,
                            }
                        }).done(function (data) {
                            if (data.errors) {
                                console.log(data);
                                App.showNotiError('Ha ocurrido un problema en el servidor');
                            } else {
                                self.imagen_encode = data.mensaje;
                            }
                        })
                    }

                }
            },
            methods: {
                addNoValido: function () {
                    return (this.imagen === '');
                },
                actionAddElement: function () {
                    this.$validator.validate().then(function (result) {
                        if (result) {
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('imagen.encode') !!}',
                                data: {
                                    'imagen': vmContext.imagen,
                                    'width': 700,
                                    'height': 540,
                                }
                            }).done(function (data) {
                                if (data.errors) {
                                    console.log(data);
                                    App.showNotiError('Ha ocurrido un problema en el servidor');
                                } else {
                                    vmContext.imagenes_db.push({'imagen': vmContext.imagen, 'encode': data.mensaje});
                                    vmContext.imagen = '';
                                }
                            })
                        }
                    })
                },
                quitaDeArreglo: function (arreglo, posicion) {
                    vmContext[arreglo].splice(posicion, 1);
                },
                publicar: function () {
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('imagen.home_publicar') !!}',
                        data: {
                            'imagenes': vmContext.imagenes_db.map(x => x.imagen)
                        }
                    }).done(function (data) {
                        if (data.errors) {
                            console.log(data);
                            App.showNotiError('Ha ocurrido un problema en el servidor');
                        } else {
                            App.showNotiSuccess('Imágenes Publicadas Correctamente');
                        }
                    })
                },
            }
        });
    </script>
@endsection
