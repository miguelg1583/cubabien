<div id="tradModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="tradModalTitle">beberbtwbtr</h4>
            </div>
            <div class="modal-body">


                <div class="" role="tabpanel">
                    <ul id="tradTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" v-for="(val, index) in idiomas" :class="{ 'active': index==0 }"><a
                                    :href="'#tab_'+val.sigla" :id="val.sigla+'-tab'" role="tab"
                                    data-toggle="tab" :aria-expanded="index==0 ? 'true' : 'false'">@{{ val.nombre }}</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" v-for="(val, index) in idiomas"
                             :class="{'tab-pane': true, 'fade': true, 'active': index==0, in: index==0}"
                             :id="'tab_'+val.sigla"
                             :aria-labelledby="val.sigla+'-tab'">
                            <form class="form-horizontal form-label-left" novalidate autocomplete="off" data-vv-scope="modal_trad">

                                {{--<div :class="{'item':true, 'form-group':true, 'has-error':errors.has('modal_trad.grupo')}">--}}
                                    {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="grupo">Grupo <span--}}
                                                {{--class="required">*</span>--}}
                                    {{--</label>--}}
                                    {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                        {{--<input id="grupo" class="form-control col-md-7 col-xs-12 autocomplete_field"--}}
                                               {{--name="grupo"--}}
                                               {{--type="text" v-model="traduccion.group"--}}
                                               {{--data-vv-scope="modal_trad"--}}
                                               {{--v-validate="'required|alpha_dash|min:3|max:50'" autocomplete="off" disabled>--}}
                                        {{--<span class="help-block">@{{ errors.first('modal_trad.grupo') }}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div :class="{'item':true, 'form-group':true, 'has-error':errors.has('modal_trad.llave')}">--}}
                                    {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="llave">Llave <span--}}
                                                {{--class="required">*</span>--}}
                                    {{--</label>--}}
                                    {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                        {{--<input id="llave" class="form-control col-md-7 col-xs-12" name="llave"--}}
                                               {{--type="text" v-model="traduccion.key"--}}
                                               {{--data-vv-scope="modal_trad"--}}
                                               {{--v-validate="'required|alpha_dash|min:3|max:50'">--}}
                                        {{--<span class="help-block">@{{ errors.first('modal_trad.llave') }}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div :class="{'item':true, 'form-group':true, 'has-error':errors.has('modal_trad.valor_'+val.sigla)}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" :for="'valor_'+val.sigla">Valor
                                        <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <fe-summernote data-vv-scope="modal_trad"
                                                       v-validate="'required'"
                                                       v-model="traduccion.text[index].text"
                                                       :name="'valor_'+val.sigla"></fe-summernote>
                                        <span class="help-block">@{{ errors.first('modal_trad.valor_'+val.sigla) }}</span>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="send" type="submit" class="btn btn-success" v-on:click.prevent="actionModal()"><span
                            class='fa fa-check'></span>Guardar
                </button>
            </div>
        </div>
    </div>
</div>