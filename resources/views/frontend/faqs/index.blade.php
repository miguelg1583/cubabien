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
            <div class="row">
                <div class="col-md-5">
                    <div class="panel-group">
                        <ul class="list-unstyled">
                            @for($i=0; $i<$categorias->count(); $i++)
                                @if($i===0)
                                    @if(count($categorias[$i]->preguntas_resp)!=0)
                                        <li class="panel-faq panel-filled support-question active" data-aos="fade-up">
                                            <a href="#preg_resp-cat{{$categorias[$i]->id}}" class="categoria_box"
                                               data-toggle="tab"
                                               aria-expanded="true" data-id="{{$categorias[$i]->id}}">
                                                <div class="panel-body">
                                                    <h4 class="font-bold ">{!! __($categorias[$i]->nb_trad) !!}</h4>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    @if(count($categorias[$i]->preguntas_resp)!=0)
                                        <li class="panel-faq panel-filled support-question" data-aos="fade-up">
                                            <a href="#preg_resp-cat{{$categorias[$i]->id}}" class="categoria_box"
                                               data-toggle="tab"
                                               aria-expanded="false" data-id="{{$categorias[$i]->id}}">
                                                <div class="panel-body">
                                                    <h4 class="font-bold ">{!! __($categorias[$i]->nb_trad) !!}</h4>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endfor
                        </ul>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel-faq">
                        <div class="panel-body answer-panel">
                            <div class="tab-content">
                                @for($i=0; $i<count($categorias); $i++)
                                    @if($i===0)
                                        <div id="preg_resp-cat{{$categorias[$i]->id}}" class="tab-pane active">
                                            @foreach($categorias[$i]->preguntas_resp as $preg_resp)
                                                <a class="preg_link" href="{{route('faq.full')}}#preg_resp{{$preg_resp->id}}" data-id="{{$preg_resp->id}}"><h4>{!! __($preg_resp->pregunta_trad) !!}</h4></a>
                                                <br>
                                            @endforeach
                                            <hr>
                                            <div class="faq-footer">
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">
                                                    {{--Last Update--}}
                                                    {{--<br>--}}
                                                    {{--<p>08/05/2019</p>--}}
                                                    <a href="{{route('faq.full')}}#categoria{{$preg_resp->categoria_faq_id}}" class="button btn btn-sm btn-radius25 btn-red">{{__('button.read-full-article')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="preg_resp-cat{{$categorias[$i]->id}}" class="tab-pane">
                                            @foreach($categorias[$i]->preguntas_resp as $preg_resp)
                                                <a href="{{route('faq.full')}}#preg_resp{{$preg_resp->id}}"><h4>{!! __($preg_resp->pregunta_trad) !!}</h4></a>
                                                <br>
                                            @endforeach
                                            <hr>
                                            <div class="faq-footer">
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">
                                                    {{--Last Update--}}
                                                    {{--<br>--}}
                                                    {{--<p>08/05/2019</p>--}}
                                                    <a href="{{route('faq.full')}}#categoria{{$preg_resp->categoria_faq_id}}" class="button btn btn-sm btn-radius25 btn-red">{{__('button.read-full-article')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- faq section -->
@endsection

@section('js')
    <script type="text/javascript">
        $("ul.list-unstyled>li.panel-faq").on("click", ".categoria_box", function () {
            let self = $(this);
            App.initAjaxFront();
            $.ajax({
                type: 'POST',
                url: "{!! route('sum_categ') !!}",
                data: {
                    'id': self.data("id"),
                },
                success: function (data) {
                    if (data.errors) {
                        console.log(data);
                    }
                },
            });
        });

        $(".preg_link").on("click", function () {
            let self = $(this);
            App.initAjaxFront();
            $.ajax({
                type: 'POST',
                url: "{!! route('sum_preg') !!}",
                data: {
                    'id': self.data("id"),
                },
                success: function (data) {
                    if (data.errors) {
                        console.log(data);
                    }
                },
            });
        });
    </script>
@endsection
