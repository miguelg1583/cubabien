@extends('frontend.layouts.master')

@section('title', __('travel-agent.register'))

@section('css')
    <link href="{{assets_file('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('title_content', '')

@section('content')
    <div class="header1 services-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="text-container text-left">
                        <h2>{{__('travel-agent.register')}}</h2>
                        <p>{!! __('travel-agent.p1') !!}</p>
                        <p>{!! __('travel-agent.p3') !!}</p>
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

    <!-- single project example -->
    <div class="single-project">
        <div class="container">
            <div class="row">
                <div class="project">
                    <div class="col-sm-6">
                        <div class="text-container right-margin" id="app" v-cloak>
                            <form class="form-horizontal form-label-left" novalidate autocomplete="off">
                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.agency_name')}">
                                    <input id="agency_name" type="text" name="agency_name" class="form-control"
                                           placeholder="{{__('labelplaceholder.agency_name')}} *" v-model="agencia.name"
                                           data-vv-scope="agencia" data-vv-as="{{__('labelplaceholder.agency_name')}}"
                                           v-validate="'required|min:3|max:100'">
                                    <div class="help-block" style="color: red">@{{ errors.first('agencia.agency_name')
                                        }}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.address')}">
                                    <input id="address" type="text" name="address" class="form-control"
                                           placeholder="{{__('labelplaceholder.address')}} *" v-model="agencia.address"
                                           data-vv-scope="agencia" data-vv-as="{{__('labelplaceholder.address')}}"
                                           v-validate="'required|min:3|max:100'">
                                    <div class="help-block" style="color: red">@{{ errors.first('agencia.address') }}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.email')}">
                                    <input id="email" type="text" name="email" class="form-control"
                                           placeholder="{{__('labelplaceholder.agency_email')}} *"
                                           v-model="agencia.email"
                                           data-vv-scope="agencia" data-vv-as="{{__('labelplaceholder.agency_email')}}"
                                           v-validate="'required|email'">
                                    <div class="help-block" style="color: red">@{{ errors.first('agencia.email') }}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true}">
                                    <input id="d_b_num" type="text" name="d_b_num" class="form-control"
                                           placeholder="D&B #" v-model="agencia.d_b_num">
                                    <div class="help-block" style="color: red"></div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.phone_num')}">
                                    <input id="phone_num" type="text" name="phone_num" class="form-control"
                                           placeholder="{{__('labelplaceholder.phone_num')}} *"
                                           v-model="agencia.phone_num"
                                           data-vv-scope="agencia" data-vv-as="{{__('labelplaceholder.phone_num')}}"
                                           v-validate="'required|max:100'">
                                    <div class="help-block" style="color: red">@{{ errors.first('agencia.phone_num')}}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.year_business')}">
                                    <input id="year_business" type="number" name="year_business" class="form-control"
                                           placeholder="{{__('labelplaceholder.year_business')}} *"
                                           v-model="agencia.year_business"
                                           data-vv-scope="agencia" data-vv-as="{{__('labelplaceholder.year_business')}}"
                                           v-validate="rule_year">
                                    <div class="help-block" style="color: red">@{{ errors.first('agencia.year_business')
                                        }}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.travel_permit_filename')}">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-default btn-file">
                                            <span class="fileinput-new">{{__('travel-agent.fileinput-new')}}</span>
                                            <span class="fileinput-exists">{{__('travel-agent.fileinput-exists')}}</span>
                                            <input type="file" id="travel_permit_file" name="travel_permit_file" @change="processFile"
                                                   accept="application/pdf"/>
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                           style="float: none">×</a>
                                    </div>
                                    <div class="help-block" style="color: red">@{{
                                        errors.first('agencia.travel_permit_file') }}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.iata_num')}">
                                    <input id="iata_num" type="text" name="iata_num" class="form-control"
                                           placeholder="IATA # *"
                                           v-model="agencia.iata_num"
                                           data-vv-scope="agencia" data-vv-as="IATA #"
                                           v-validate="'required|max:100'">
                                    <div class="help-block" style="color: red">@{{ errors.first('agencia.iata_num')}}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.owner_name')}">
                                    <input id="owner_name" type="text" name="owner_name" class="form-control"
                                           placeholder="{{__('labelplaceholder.owner_name')}} *"
                                           v-model="agencia.owner_name"
                                           data-vv-scope="agencia" data-vv-as="{{__('labelplaceholder.owner_name')}}"
                                           v-validate="'required|max:100'">
                                    <div class="help-block" style="color: red">@{{
                                        errors.first('agencia.owner_name')}}
                                    </div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.title')}">
                                    <input id="title" type="text" name="title" class="form-control"
                                           placeholder="{{__('labelplaceholder.title')}} *"
                                           v-model="agencia.title"
                                           data-vv-scope="agencia" data-vv-as="{{__('labelplaceholder.title')}}"
                                           v-validate="'required|max:15'">
                                    <div class="help-block" style="color: red">@{{ errors.first('agencia.title')}}</div>
                                </div>

                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.anual_sales_volume')}">
                                    <input id="anual_sales_volume" type="text" name="anual_sales_volume"
                                           class="form-control"
                                           placeholder="{{__('labelplaceholder.anual_sales_volume')}} *"
                                           v-model="agencia.anual_sales_volume"
                                           data-vv-scope="agencia"
                                           data-vv-as="{{__('labelplaceholder.anual_sales_volume')}}"
                                           v-validate="'required|max:15'">
                                    <div class="help-block" style="color: red">@{{
                                        errors.first('agencia.anual_sales_volume')}}
                                    </div>
                                </div>


                                <div class="{'form-group':true, 'form_left':true, 'has-error':errors.has('agencia.captcha')}">
                                    <div class="captcha">
                                        <span id="captcha-img">{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-red btn-sm radius25"
                                                v-on:click.prevent="refreshCaptcha()"><span
                                                    class="fa fa-refresh"></span></button>
                                        <input id="form_captcha" type="text" name="captcha" class="form-control"
                                               placeholder="Captcha *" v-model="agencia.captcha"
                                               data-vv-scope="agencia" v-validate="'required'">
                                        <div class="help-block" style="color: red">@{{ errors.first('agencia.captcha') }}
                                        </div>
                                    </div>
                                </div>


                            </form>
                            <div class="buttons">
                                <button class="btn btn-red btn-sm radius25"
                                        v-on:click.prevent="sendRegistro()"> {{__('button.send-message')}} </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-container right-margin">
                            <p>
                                {!! __('travel-agent.p3') !!}
                            </p>
                            <div class="buttons">
                                <a href="https://www.irs.gov/pub/irs-pdf/fw9.pdf" class="btn button btn-md btn-outline-dark radius25" target="_blank">{{__('button.download')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- simple project example end -->
@endsection

@section('js')
    <script src="{{assets_file('vendor/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    {{--    <script src="{{assets_file('vendor/vue2-dropzone/dist/vue2Dropzone.js')}}"></script>--}}
    <script type="text/javascript">
        ("{{session('locale')}}" === "" || "{{session('locale')}}" !== "es") ? Vue.use(VeeValidate, {locale: 'en'}) : Vue.use(VeeValidate, {locale: '{{session('locale')}}'});

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
                agencia: {
                    name: "",
                    address: "",
                    email: "",
                    d_b_num: "",
                    phone_num: "",
                    year_business: "",
                    travel_permit_filename: "",
                    travel_permit_file: "",
                    iata_num: "",
                    owner_name: "",
                    title: "",
                    anual_sales_volume: "",
                    captcha: ""
                },
            },
            computed: {
                rule_year: function () {
                    let d = new Date();

                    return 'required|digits:4|between:1900,' + d.getFullYear();
                }
            },
            methods: {
                processFile: function (event) {
                    // console.log('Evento', event);
                    // this.agencia.travel_permit_file = event.target.files[0]
                    let self = this;
                    let file = event.target.files[0];
                    // console.log(file);
                    if (file.size / 1048576 > 2.5) {
                        const fieldError = {
                            field: 'agencia.travel_permit_file',
                            msg: '{{__('travel-agent.file-error-size')}}'
                        };
                        self.errors.add(fieldError);
                        return;
                    }
                    if (this.getFileExtension3(file.name) !== 'pdf') {
                        const fieldError = {
                            field: 'agencia.travel_permit_file',
                            msg: '{{__('travel-agent.file-error-ext')}}'
                        };
                        vmContext.errors.add(fieldError);
                        return;
                    }
                    let fr = new FileReader();
                    //fr.readAsText(file);
                    fr.onloadend = function () {
                        self.agencia.travel_permit_file = fr.result;
                        self.agencia.travel_permit_filename = file.name;
                    };
                    if (file) {
                        fr.readAsDataURL(file);
                    }
                },
                getFileExtension3: function (filename) {
                    return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
                },
                refreshCaptcha: function () {
                    $.ajax({
                        type: 'GET',
                        url: '{!! route('captcha.refresh') !!}',
                        success: function (data) {
                            if (data.errors) {
                                console.log(data);
                                App.showNotiError('{{__('message.error')}}');
                            } else {
                                $("#captcha-img").html(data.captcha)
                            }
                        },
                    });
                },
                setInicial: function () {
                    self = this;
                    this.agencia.name = "";
                    this.agencia.address = "";
                    this.agencia.email = "";
                    this.agencia.d_b_num = "";
                    this.agencia.phone_num = "";
                    this.agencia.year_business = "";
                    this.agencia.travel_permit_filename = "";
                    this.agencia.travel_permit_file = "";
                    this.agencia.iata_num = "";
                    this.agencia.owner_name = "";
                    this.agencia.title = "";
                    this.agencia.anual_sales_volume = "";
                    this.agencia.captcha = "";
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset('agencia');
                            this.errors.clear();
                            self.refreshCaptcha();
                            $('.fileinput').fileinput("clear");
                        });

                },
                sendRegistro: function () {
                    this.$validator.validateAll('agencia').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('travel_agent.storeRegister') !!}',
                                data: {
                                    'agencia': vmContext.agencia,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        if (data.errors.captcha) {
                                            App.showNotiNotice('{{__('message.noti-contact')}}');
                                            const fieldError = {
                                                field: 'agencia.captcha',
                                                msg: '{{__('contact.captcha-error')}}'
                                            };
                                            vmContext.errors.add(fieldError);
                                            vmContext.refreshCaptcha();
                                        } else {
                                            App.showNotiError('{{__('message.error')}}');
                                        }
                                    } else {
                                        App.showNotiSuccess('{{__('message.success-contact')}}');
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
