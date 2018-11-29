@extends('backend.layouts.master')

@section('title', 'Tours - Crear')

@section('css')
    <link rel="stylesheet" href="{{assets_file('vendor/leaflet/leaflet.css')}}"/>
@endsection

@section('title_content', 'Tours')

@section('content')
    <div id="app" v-cloak>
        @include('backend.traducciones.partial.cu_modal')
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-file-code-o"></i> Agregar
                    <small>inserte las traducciones desde el boton en cada campo</small>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <!-- Smart Wizard -->
                <p>Debe llenar todos los datos para que quede funcional el Tour</p>
                <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                        <li>
                            <a href="#step-1">
                                <span class="step_no">1</span>
                                <span class="step_descr">
                                              Tour<br/>
                                              <small>Datos en general</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <span class="step_no">2</span>
                                <span class="step_descr">
                                              Itinerario<br/>
                                              <small>por días</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <span class="step_no">3</span>
                                <span class="step_descr">
                                              Calendario<br/>
                                              <small>Fechas y Precios</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <span class="step_no">4</span>
                                <span class="step_descr">
                                              Mapa<br/>
                                              <small>Puntos importantes a visitar</small>
                                          </span>
                            </a>
                        </li>
                    </ul>
                    <div id="step-1">
                        <form class="form-horizontal form-label-left">
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.nombre')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input id="nombre" class="form-control col-md-4 col-xs-12"
                                               name="nombre"
                                               type="text" v-model="tour.nb.valor"
                                               data-vv-scope="tour"
                                               v-validate="'required|min:5|max:190'">
                                        <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Nombre')"
                                            :disabled="valorNoLLeno(tour.nb.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                </span>
                                    </div>
                                    <span class="help-block">@{{ errors.first('tour.nombre') }}</span>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.introduccion')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="introduccion">Introducción
                                    <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <fe-summernote id="introduccion" class="form-control col-md-4 col-xs-12"
                                                       name="introduccion"
                                                       type="text" v-model="tour.introd.valor"
                                                       data-vv-scope="tour"
                                                       v-validate="'required|min:5'"></fe-summernote>
                                        <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Introducción')"
                                            :disabled="valorNoLLeno(tour.introd.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                </span>
                                    </div>
                                    <span class="help-block">@{{ errors.first('tour.introduccion') }}</span>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.dias')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dias">Num de Días
                                    <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="dias" class="form-control col-md-7 col-xs-12"
                                           name="dias"
                                           type="number"
                                           data-vv-scope="tour"
                                           v-model="tour.num_dias"
                                           v-validate="'required|integer|min_value:1'">
                                    <span class="help-block">@{{ errors.first('tour.dias') }}</span>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('tour.noches')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noches">Num de Noches
                                    <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="noches" class="form-control col-md-7 col-xs-12"
                                           name="noches"
                                           type="number"
                                           data-vv-scope="tour"
                                           v-model="tour.num_noches"
                                           v-validate="'required|integer'" disabled>
                                    {{--<span class="help-block">@{{ errors.first('tour.noches') }}</span>--}}
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Día de Salida <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" id="domingo_sal" value="0" v-model="tour.salida_dia"
                                           checked>
                                    <label for="domingo_sal">Dom</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="lunes_sal" value="1" v-model="tour.salida_dia">
                                    <label for="lunes_sal">Lun</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="martes_sal" value="2" v-model="tour.salida_dia">
                                    <label for="martes_sal">Mar</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="miercoles_sal" value="3" v-model="tour.salida_dia">
                                    <label for="miercoles_sal">Mié</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="jueves_sal" value="4" v-model="tour.salida_dia">
                                    <label for="jueves_sal">Jue</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="viernes_sal" value="5" v-model="tour.salida_dia">
                                    <label for="viernes_sal">Vie</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="sabado_sal" value="6" v-model="tour.salida_dia">
                                    <label for="sabado_sal">Sáb</label>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Día de Llegada <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" id="domingo_lleg" value="0" v-model="tour.llegada_dia">
                                    <label for="domingo_lleg">Dom</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="lunes_lleg" value="1" v-model="tour.llegada_dia">
                                    <label for="lunes_lleg">Lun</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="martes_lleg" value="2" v-model="tour.llegada_dia">
                                    <label for="martes_lleg">Mar</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="miercoles_lleg" value="3" v-model="tour.llegada_dia">
                                    <label for="miercoles_lleg">Mié</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="jueves_lleg" value="4" v-model="tour.llegada_dia">
                                    <label for="jueves_lleg">Jue</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="viernes_lleg" value="5" v-model="tour.llegada_dia">
                                    <label for="viernes_lleg">Vie</label>
                                    &nbsp;&nbsp;
                                    <input type="radio" id="sabado_lleg" value="6" v-model="tour.llegada_dia">
                                    <label for="sabado_lleg">Sáb</label>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div id="step-2">
                        {{--<h2 class="StepTitle">Step 2 Content</h2>--}}
                        <form class="form-horizontal form-label-left">
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('itinerario.dia')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Dia
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="dia" class="form-control col-md-7 col-xs-12"
                                           name="dia"
                                           type="number"
                                           data-vv-scope="itinerario"
                                           v-model="itinerario.dia"
                                           v-validate="'required|integer|min_value:1'">
                                    <span class="help-block">@{{ errors.first('itinerario.dia') }}</span>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('itinerario.contenido')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contenido">Contenido
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <fe-summernote id="contenido" class="form-control col-md-4 col-xs-12"
                                                       name="contenido"
                                                       type="text" v-model="itinerario.contenido.valor"
                                                       data-vv-scope="itinerario"
                                                       v-validate="'required|min:5'"></fe-summernote>
                                        <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Contenido')"
                                            :disabled="valorNoLLeno(itinerario.contenido.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                </span>
                                        <button class="btn btn-round btn-success"
                                                v-on:click.prevent="actionAddElement('itinerario')"
                                                :disabled="addNoValido('itinerario')">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </div>
                                    <span class="help-block">@{{ errors.first('itinerario.contenido') }}</span>
                                </div>

                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <ul class="list-unstyled timeline">
                            <li v-for="(itine, pos_itine) in itinerario_tour">
                                <div class="block">
                                    <div class="tags">
                                        <a href="javascript:void;" class="tag">
                                            <span>Día @{{ itine.dia }}</span>
                                        </a>
                                        {{--<span class="tag">Día @{{ itine.dia }}</span>--}}
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                            @{{ pos_itine + 1 }} de los @{{ tour.num_dias }}
                                        </h2><br>
                                        <a href="javascript:;" class="label label-danger"
                                           v-on:click.prevent="quitaDeArreglo('itinerario_tour', pos_itine)"><span
                                                    class="glyphicon glyphicon-trash"></span></a>
                                        <div class="byline">
                                            <span>le quedan @{{ tour.num_dias - pos_itine - 1 }}</span> por
                                            <a>llenar</a>
                                        </div>
                                        {{--<p class="excerpt">@{{ itine.contenido.valor }}</p>--}}
                                        <p class="excerpt"><span v-html="itine.contenido.valor"></span></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div id="step-3">
                        {{--<h2 class="StepTitle">Step 3 Content</h2>--}}
                        <form class="form-horizontal form-label-left">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Desde - Hasta
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div id="fecha-rango"
                                         style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('fecha.precio_single')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="precio_sigle">Precio
                                    Single Pax
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <input id="precio_single" class="form-control col-md-7 col-xs-12"
                                           name="precio_single"
                                           type="text"
                                           data-vv-scope="fecha"
                                           v-model="fecha.precio_s_pax"
                                           v-validate="'required|decimal:2'">
                                    <span class="help-block">@{{ errors.first('fecha.precio_single') }}</span>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('fecha.precio_double')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="precio_double">Precio
                                    Double Pax
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <input id="precio_double" class="form-control col-md-7 col-xs-12"
                                           name="precio_double"
                                           type="text"
                                           data-vv-scope="fecha"
                                           v-model="fecha.precio_d_pax"
                                           v-validate="'required|decimal:2'">
                                    <span class="help-block">@{{ errors.first('fecha.precio_double') }}</span>
                                </div>
                                <button class="btn btn-round btn-success"
                                        v-on:click.prevent="actionAddElement('fecha')"
                                        :disabled="addNoValido('fecha')">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Desde</th>
                                        <th>Hasta</th>
                                        <th>Precio Single Pax</th>
                                        <th>Precio Double Pax</th>
                                        <th>Operaciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(fech, pos_fech) in fecha_tour">
                                        <td>@{{ fech.desde }}</td>
                                        <td>@{{ fech.hasta }}</td>
                                        <td>$ @{{ fech.precio_s_pax }}</td>
                                        <td>$ @{{ fech.precio_d_pax }}</td>
                                        <td><a href="javascript:;" class="label label-danger"
                                               v-on:click.prevent="quitaDeArreglo('fecha_tour', pos_fech)"><span
                                                        class="glyphicon glyphicon-trash"></span></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="step-4">
                        {{--<h2 class="StepTitle">Step 4 Content</h2>--}}
                        <form class="form-horizontal form-label-left">
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('mapa.latitud')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitud">Latitud
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <input id="latitud" class="form-control col-md-7 col-xs-12"
                                           name="latitud"
                                           type="text"
                                           data-vv-scope="mapa"
                                           v-model="mapa.latitud"
                                           v-validate="'required|between:-90.999999,90.999999'">
                                    <span class="help-block">@{{ errors.first('mapa.latitud') }}</span>
                                </div>
                            </div>

                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('mapa.longitud')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longitud">Longitud
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <input id="longitud" class="form-control col-md-7 col-xs-12"
                                           name="longitud"
                                           type="text"
                                           data-vv-scope="mapa"
                                           v-model="mapa.longitud"
                                           v-validate="'required|between:-180.999999,180.999999'">
                                    <span class="help-block">@{{ errors.first('mapa.longitud') }}</span>
                                </div>
                            </div>
                            <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('mapa.etiqueta')}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="etiqueta">Etiqueta <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input id="etiqueta" class="form-control col-md-4 col-xs-12"
                                               name="etiqueta"
                                               type="text"
                                               v-model="mapa.etiqueta.valor"
                                               data-vv-scope="mapa"
                                               v-validate="'required|min:2|max:190'">
                                        <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"
                                            v-on:click.prevent="showTradModal('Etiqueta')"
                                            :disabled="valorNoLLeno(mapa.etiqueta.valor)">
                                        <span class="fa fa-language"></span>
                                    </button>
                                        </span>
                                    </div>
                                    <span class="help-block">@{{ errors.first('mapa.etiqueta') }}</span>

                                </div>
                                <button class="btn btn-round btn-success"
                                        v-on:click.prevent="actionAddElement('mapa')"
                                        :disabled="addNoValido('mapa')">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </div>

                        </form>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Latitud</th>
                                        <th>Logitud</th>
                                        <th>Etiqueta</th>
                                        <th>Operación</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(coord, pos_coord) in mapa_tour">
                                        <td>@{{ coord.latitud }}</td>
                                        <td>@{{ coord.longitud }}</td>
                                        <td>@{{ coord.etiqueta.valor }}</td>
                                        <td><a href="javascript:;" class="label label-danger"
                                               v-on:click.prevent="quitaDeArreglo('mapa_tour', pos_coord)"><span
                                                        class="glyphicon glyphicon-trash"></span></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div id="mapOpenStreet">
                                {{--<div id="myMap" style="border:0; height: 400px; width: 100%"></div>--}}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End SmartWizard Content -->


                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary" :disabled="isNoValido"
                                v-on:click.prevent="createLista()"><span
                                    class='fa fa-list'></span>Guardar y Regresar al listado
                        </button>
                        <button id="send" type="submit" class="btn btn-success" :disabled="isNoValido"
                                v-on:click.prevent="createAgrega()"><span
                                    class='fa fa-check'></span>Guardar y Agregar otro
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{assets_file('vendor/leaflet/leaflet.js')}}"></script>
    <script type="text/javascript">
        Vue.use(VeeValidate, {locale: 'es'});
        window.vmContext = new Vue({
            el: "#app",
            beforeCreate() {
                App.init("{{config('app.url')}}");
                App.initVue();
            },
            created() {
                this.setInicial();
                this.setInicialTrad();
                App.initAjax();
                // this.dibujaMapa();
            },
            mounted() {
                this.initDateRangePicker();
                this.dibujaMapa();
                App.initSmartWizard(this.propertiesSmartWizard);
            },

            data: {
                idiomas: {!! json_encode($idiomas) !!},
                campo_trad: "",    //esto es para el actionmodal, poder insertar el objeto de traduccion en cada columna
                tour: {
                    nb: {
                        valor: "",
                        @include('backend.traducciones.partial.vdata_trad')
                    },
                    introd: {
                        valor: "",
                        @include('backend.traducciones.partial.vdata_trad')
                    },
                    num_dias: 0,
                    num_noches: 0,
                    // ver esto hacero como alain
                    salida_dia: '0',
                    llegada_dia: '0'
                    // ver esto hacero como alain
                },
                itinerario_tour: [],
                itinerario: {
                    dia: 1,
                    contenido: {
                        valor: "",
                        @include('backend.traducciones.partial.vdata_trad')
                    }
                },
                fecha_tour: [],
                fecha: {
                    desde: "",
                    hasta: "",
                    precio_s_pax: "",
                    precio_d_pax: "",
                },
                mapa_tour: [],
                mapa: {
                    latitud: "",
                    longitud: "",
                    etiqueta: {
                        valor: "",
                        @include('backend.traducciones.partial.vdata_trad')
                    }
                },
                propertiesSmartWizard: {
                    // Properties
                    selected: 0,  // Selected Step, 0 = first step
                    keyNavigation: false, // Enable/Disable key navigation(left and right keys are used if enabled)
                    enableAllSteps: false,  // Enable/Disable all steps on first load
                    transitionEffect: 'none', // Effect on navigation, none/fade/slide/slideleft
                    contentURL: null, // specifying content url enables ajax content loading
                    contentURLData: null, // override ajax query parameters
                    contentCache: true, // cache step contents, if false content is fetched always from ajax url
                    cycleSteps: false, // cycle step navigation
                    enableFinishButton: false, // makes finish button enabled always
                    hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
                    errorSteps: [],    // array of step numbers to highlighting as error steps
                    labelNext: 'Siguiente', // label for Next button
                    labelPrevious: 'Anterior', // label for Previous button
                    labelFinish: 'Finalizar',  // label for Finish button
                    noForwardJumping: false,
                    ajaxType: 'POST',
                    // Events
                    onLeaveStep: null, // triggers when leaving a step
                    onShowStep: null,  // triggers when showing a step
                    onFinish: null,  // triggers when Finish button is clicked
                    // buttonOrder: ['finish', 'next', 'prev']  // button order, to hide a button remove it from the list
                    buttonOrder: ['prev', 'next']  // button order, to hide a button remove it from the list
                },
                // include----------------------------
                @include('backend.traducciones.partial.vdata_trad')
                //cierra include----------------------------

            },
            computed: {
                isNoValido() {
                    // return Object.keys(this.fields).some(key => key!=='$modal_trad' && this.fields[key].validated === false) || this.errors.any();
                    let self = this;
                    if (self.errors.has('tour.*')) {
                        return true;
                    } else {
                        if (this.fields['$tour']) {
                            Object.keys(this.fields['$tour']).forEach(function (item) {
                                if (item.validated === false) {
                                    return true;
                                }
                            });
                        }
                    }
                    return this.fecha_tour.length === 0 || this.itinerario_tour.length === 0 || this.mapa_tour.length === 0;
                },


            },
            watch: {
                'tour.num_dias': function () {
                    this.tour.num_noches = this.tour.num_dias - 1;
                },
            },
            methods: {
                valorNoLLeno: function (campo) {
                    return campo === ""
                },
                addNoValido: function (step) {
                    let self = this;
                    switch (step) {
                        case "itinerario":
                            return !!(this.tour.num_dias == this.itinerario_tour.length || this.errors.has('itinerario.*'));
                            break;
                        case "fecha":
                            return !!(this.errors.has('fecha.*') || $('#fecha-rango').find('span').html() === "");
                            break;
                        case "mapa":
                            return !!(this.errors.has('mapa.*'));
                            break;
                    }
                }
                ,
                setInicial: function () {
                    self = this;
                    this.campo_trad = "";
                    this.tour = {
                        nb: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        },
                        introd: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        },
                        num_dias: 0,
                        num_noches: 0,
                        // ver esto hacero como alain
                        salida_dia: '0',
                        llegada_dia: '0'
                        // ver esto hacero como alain
                    };
                    this.itinerario_tour = [];
                    this.itinerario = {
                        dia: 1,
                        contenido: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        }
                    };
                    this.fecha_tour = [];
                    this.fecha = {
                        desde: "",
                        hasta: "",
                        precio_s_pax: "",
                        precio_d_pax: "",
                    };
                    this.mapa_tour = [];
                    this.mapa = {
                        latitud: "",
                        longitud: "",
                        etiqueta: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        }
                    };
                    this.idiomas.forEach(function (item) {
                        self.tour.nb.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                        self.tour.introd.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                        self.itinerario.contenido.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                        self.mapa.etiqueta.traduccion.text.push({
                            lengua: item.sigla,
                            text: ''
                        });
                    });
                    this.$nextTick()
                        .then(() => {
                            this.$validator.reset().then(() => {
                                this.errors.clear()
                            });
                            // this.errors.clear();
                        });
                }
                ,
                //include --------------------------------------
                @include('backend.traducciones.partial.vmethod_trad')
                //cierra  include --------------------------------------
                createLista: function () {
                    this.$validator.validate('tour.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('tour.store') !!}',
                                data: {
                                    'tour': vmContext.tour,
                                    'itinerario_tour': vmContext.itinerario_tour,
                                    'fecha_tour': vmContext.fecha_tour,
                                    'mapa_tour': vmContext.mapa_tour,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema Revise los datos');
                                    } else {
                                        App.showNotiSuccess('Tour creado satisfactoriamente');
                                        window.location.replace("{!! route('tour.index') !!}");
                                    }
                                },
                            });

                        }
                    });
                }
                ,
                createAgrega: function () {
                    this.$validator.validate('tour.*').then(function (result) {
                        if (result) {
                            //aqui llamo api create
                            $.ajax({
                                type: 'POST',
                                url: '{!! route('tour.store') !!}',
                                data: {
                                    'tour': vmContext.tour,
                                    'itinerario_tour': vmContext.itinerario_tour,
                                    'fecha_tour': vmContext.fecha_tour,
                                    'mapa_tour': vmContext.mapa_tour,
                                },
                                success: function (data) {
                                    if (data.errors) {
                                        console.log(data);
                                        App.showNotiError('Ha ocurrido un problema Revise los datos');
                                    } else {
                                        App.showNotiSuccess('Tour creado satisfactoriamente');
                                        vmContext.setInicial();
                                        vmContext.setInicialTrad();
                                    }
                                },
                            });

                        }
                    });
                }
                ,
                actionModal: function () {
                    this.$validator.validateAll('modal_trad').then((result) => {
                        if (result) {
                            switch (vmContext.campo_trad) {
                                case "Nombre":
                                    vmContext.tour.nb.traduccion = vmContext.traduccion;
                                    vmContext.setInicialTrad();
                                    $("#tradModal").modal("hide");
                                    break;
                                case "Introducción":
                                    vmContext.tour.introd.traduccion = vmContext.traduccion;
                                    vmContext.setInicialTrad();
                                    $("#tradModal").modal("hide");
                                    break;
                                case "Contenido":
                                    vmContext.itinerario.contenido.traduccion = vmContext.traduccion;
                                    vmContext.setInicialTrad();
                                    $("#tradModal").modal("hide");
                                    break;
                                case "Etiqueta":
                                    vmContext.mapa.etiqueta.traduccion = vmContext.traduccion;
                                    vmContext.setInicialTrad();
                                    $("#tradModal").modal("hide");
                                    break;

                                // default:
                                //     vmContext.setInicialTrad();
                                //     console.log('se hizo');
                                //     $("#tradModal").modal("hide");
                                //     break;
                            }
                        }

                    });
                }
                ,
                actionAddElement: function (elemento) {
                    switch (elemento) {
                        case "itinerario":
                            this.itinerario_tour.push(this.itinerario);
                            vmContext.setInicialItinerario();
                            break;
                        case "fecha":
                            this.fecha_tour.push(this.fecha);
                            vmContext.setInicialFecha();
                            break;
                        case "mapa":
                            this.$validator.validate('mapa.*').then(function (elem) {
                                if (elem) {
                                    vmContext.mapa_tour.push(vmContext.mapa);
                                    vmContext.setInicialMapa();
                                    vmContext.dibujaMapa();
                                }
                            });
                            // this.mapa_tour.push(this.mapa);
                            // vmContext.setInicialMapa();
                            break;
                    }
                },
                setInicialMapa: function () {
                    this.mapa = {
                        latitud: "",
                        longitud: "",
                        etiqueta: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        }
                    }
                },
                setInicialFecha: function () {
                    this.fecha = {
                        desde: "",
                        hasta: "",
                        precio_s_pax: "",
                        precio_d_pax: "",
                    };
                    $('#fecha-rango').find('span').empty();
                },
                setInicialItinerario: function () {
                    this.itinerario = {
                        dia: this.itinerario.dia + 1,
                        contenido: {
                            valor: "",
                            @include('backend.traducciones.partial.vdata_trad')
                        }
                    }
                }
                ,
                stringDia: function (sum_dia) {
                    return moment().day(this.tour.salida_dia + sum_dia - sum_dia).format('dddd')
                },
                quitaDeArreglo: function (arreglo, posicion) {
                    // console.log('empezando');
                    vmContext[arreglo].splice(posicion, 1);
                    if (arreglo === "mapa_tour") {
                        this.dibujaMapa()
                    }
                    // console.log('pasado');
                },
                dibujaMapa: function () {
                    $('#mapOpenStreet').html('<div id="myMap" style="border:0; height: 400px; width: 100%"></div>');
                    let map = L.map('myMap').setView([21.504186, -79.683838], 7);
                    // let map = L.map('myMap').setView([23.08478515994374, -82.38510131835939], 7);

                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWlndWVsZzE5MDMiLCJhIjoiY2ptYWxnZjVhMDE5aTN3bzBkeXo3OTdtYiJ9.Rmrk4CQTDjsXIdSj_79G4g', {
                        maxZoom: 18,
                        attribution: 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                        id: 'mapbox.streets'
                    }).addTo(map);


                    if (this.mapa_tour.length > 0) {
                        let arrMarker = [];

                        this.mapa_tour.forEach(function (item_mapa) {
                            arrMarker.push(L.marker([Number(item_mapa.latitud), Number(item_mapa.longitud)]).bindPopup(item_mapa.etiqueta.valor).openPopup());
                            // L.marker([Number(item_mapa.latitud), Number(item_mapa.longitud)]).addTo(map)
                            //     .bindPopup(item_mapa.etiqueta.valor).openPopup();
                        });

                        L.layerGroup(arrMarker).addTo(map);
                    }

                    let popup = L.popup();

                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent("Click en: " + e.latlng.toString())
                            .openOn(map);
                        // console.log(e.latlng);
                        vmContext.mapa.latitud = e.latlng.lat;
                        vmContext.mapa.longitud = e.latlng.lng;
                        // console.log(e.latlng.lat);
                        // console.log(e.latlng.lng);
                    }

                    map.on('click', onMapClick);
                },
                initDateRangePicker: function () {
                    $('#fecha-rango').daterangepicker({
                        autoUpdateInput: false,
                        alwaysShowCalendars: true,
                        // minDate: start,
                        // maxDate: end,
                        // ranges: {
                        //     'Hoy': [moment(), moment()],
                        //     'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        //     'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
                        //     'Últimos 30 Days': [moment().subtract(29, 'days'), moment()],
                        //     'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        //     'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        // },
                        "locale": {
                            "format": "ddd, MMM DD, YYYY",
                            "separator": " - ",
                            "applyLabel": "Aceptar",
                            "cancelLabel": "Cancelar",
                            "fromLabel": "Desde",
                            "toLabel": "Hasta",
                            "customRangeLabel": "Período Personalizado",
                            "weekLabel": "Sem",
                            "daysOfWeek": [
                                "Do",
                                "Lu",
                                "Ma",
                                "Mi",
                                "Ju",
                                "Vi",
                                "Sá"
                            ],
                            "monthNames": [
                                "Enero",
                                "Febrero",
                                "Marzo",
                                "Abril",
                                "Mayo",
                                "Junio",
                                "Julio",
                                "Agosto",
                                "Septiembre",
                                "Octubre",
                                "Noviembre",
                                "Diciembre"
                            ],
                            "firstDay": 1
                        },
                    });
                }
            }
        });

        $('#fecha-rango').on('cancel.daterangepicker', function (ev, picker) {
            //do something, like clearing an input
            $('#fecha-rango').find('span').empty();
        }).on('apply.daterangepicker', function (ev, picker) {
            $('#fecha-rango').find('span').html(picker.startDate.format('ddd DD/MM/YYYY') + ' - ' + picker.endDate.format('ddd DD/MM/YYYY'));
            // console.log(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
            // console.log(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
            vmContext.fecha.desde = picker.startDate.format('DD/MM/YYYY');
            vmContext.fecha.hasta = picker.endDate.format('DD/MM/YYYY');
        });

        // $('#fecha-rango').on('apply.daterangepicker', function(ev, picker) {
        //     $('#fecha-rango').find('span').html(picker.startDate.format('ddd DD/MM/YYYY') + ' - ' + picker.endDate.format('ddd DD/MM/YYYY'));
        //     console.log(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
        //     console.log(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
        // });
    </script>
@endsection
