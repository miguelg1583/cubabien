@extends('frontend.layouts.master')

@section('title', __('menu.faq'))

@section('css')
@endsection

@section('content')
    <!-- header 1 -->
    <div class="header1 elements">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="text-container text-left">
                        <h2>{{__('faq.header-1')}}</h2>
                        <p>{{__('faq.header-2')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header 1 end -->
    <!-- faq section -->
    <section class="faq-section">
        <div class="container">
            <div class="title padding">
                <h2>
                    <span class="red-color">{{__('menu.faq')}}</span> - {{__('faq.header-1')}} </h2>
                {!! __('faq.final-notes') !!}
            </div>
        </div>
    </section>
    <!-- faq section end-->

    @foreach($categorias as $categoria)
        <div class="container" id="categoria{{$categoria->id}}" data-aos="flip-right">
            <hr>
            <h3>{!! __($categoria->nb_trad) !!}</h3>
            <hr>
        </div>

        @foreach($categoria->preguntas_resp->sortByDesc('visitas') as $preg_resp)
            <!-- text image -->
            <section class="text-image bg3" id="preg_resp{{$preg_resp->id}}" data-aos="flip-left">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="text-container">
                                <div class="text">
                                    <h4>{!! __($preg_resp->pregunta_trad) !!}</h4>
                                    <br>
                                    <div>{!! __($preg_resp->respuesta_trad) !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  text image -->
        @endforeach

    @endforeach


@endsection

@section('js')

@endsection
