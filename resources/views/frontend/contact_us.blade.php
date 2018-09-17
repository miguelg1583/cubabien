@extends('frontend.layouts.master')

@section('title', __('menu.contact'))

@section('css')
@endsection

@section('content')
    <div class="header1 contact-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="text-container text-left">
                        <h2>{{__('menu.contact')}}</h2>
                        <p>{{__('contact.header-p')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header 1 end -->
    <!-- colors -->
    <div class="colors">
        <div class="no-padding container-fluid">
            <span class="col-sm-3 col-xs-3 color1"></span>
            <span class="col-sm-3 col-xs-3 color3"></span>
            <span class="col-sm-3 col-xs-3 color2"></span>
            <span class="col-sm-3 col-xs-3 color4"></span>
        </div>
    </div>
    <!--   colors -->
    <!-- contact form -->
    <div class="container-fluid">
        <div class="row">
            {{--<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDyOnCxk3saEx4Ep_KCENBLq9cpUWJ6znU&q=Cubabien+Travel" width="100%" height="300px;" frameborder="0" allowfullscreen></iframe>--}}
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3593.6813635258154!2d-80.3169097!3d25.7480488!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b85bf6cc7de1%3A0x4500a784417f60a7!2sCubabien+Travel!5e0!3m2!1ses!2sph!4v1536956331189"
                    width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <!-- contact form end -->
    <!-- section 9 -->
    <section class="section9 contact-form">
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="app" v-cloak>
                    <form id="contact-form">
                        <div class="form-group form_left">
                            <input id="form_name" type="text" name="nombre" class="form-control"
                                   placeholder="{{__('labelplaceholder.nombre')}} *" v-model="contacto.nombre"
                                   data-vv-scope="contacto" v-validate="'required|min:3|max:100'">
                            <div class="help-block with-errors">@{{ errors.first('contacto.nombre') }}</div>
                        </div>

                        <div class="form-group form_left">
                            <input id="form_email" type="email" name="email" class="form-control"
                                   placeholder="{{__('labelplaceholder.email')}} *" v-model="contacto.email"
                                   data-vv-scope="contacto" v-validate="'required|email|min:3|max:100'">
                            <div class="help-block with-errors">@{{ errors.first('contacto.email') }}</div>
                        </div>

                        <div class="form-group form_left">
                            <textarea id="form_message" name="mensaje" class="form-control"
                                      placeholder="{{__('labelplaceholder.mensaje')}} *" rows="4" v-model="contacto.mensaje"
                                      data-vv-scope="contacto" v-validate="'required|min:3'"></textarea>
                            <div class="help-block with-errors">@{{ errors.first('contacto.mensaje') }}</div>
                            <br>
                            <button class="btn btn-red btn-sm radius25" v-on:click.prevent="sendContact()"><span
                                        class="fa fa-envelope"></span> {{__('button.send-message')}} </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="title text-left">
                        <h2>{!! __('contact.section-header') !!}</h2>
                        <p>{!! __('contact.section-p') !!}</p>
                        <br>
                        <h5><i class="fa fa-envelope fa-xs"></i> E-mail: <a href="mailto:sales@cubabientravel.com">sales@cubabientravel.com</a>
                        </h5>
                        <h5><i class="fa fa-phone fa-xs"></i> Tel: <a href="tel:+1-786-762-2280">+1 (786) 762-2280</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section 9 end -->
@endsection

@section('js')
    <script type="text/javascript">
        ("{{session('locale')}}"==="")?Vue.use(VeeValidate, {locale: 'en'}):Vue.use(VeeValidate, {locale: '{{session('locale')}}'});
        window.vmContext = new Vue({
            el: "#app",
            beforeCreate() {
                App.init("{{config('app.url')}}");
                // App.initVue();
            },
            created() {
                // this.setInicial();
                App.initAjaxFront();
            },
            data: {
                contacto: {
                    nombre: "",
                    email: "",
                    mensaje: ""
                }
            },
            methods: {
                setInicial: function () {
                    self = this;
                    this.contacto.nombre = "";
                    this.contacto.email = "";
                    this.contacto.mensaje = "";
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset('contacto');
                            this.errors.clear();
                        });
                },
                sendContact: function () {
                    this.$validator.validateAll('contacto').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('contact.store') !!}',
                                data: {
                                    'contacto': vmContext.contacto,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema en el servidor');
                                    } else {
                                        App.showNotiSuccess('Mensaje Enviado Satisfactoriamente');
                                        vmContext.setInicial();
                                    }
                                },
                            });

                        }
                    });
                },
            }
        });
    </script>
@endsection
