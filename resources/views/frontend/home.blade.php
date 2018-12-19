@extends('frontend.layouts.master')

@section('title', __('menu.home'))

@section('css')
    <style>
        /* styles for '...' */
        .block-with-text {
            /* hide text if it more than N lines  */
            overflow: hidden;
            /* for set '...' in absolute position */
            position: relative;
            /* use this value to count block height */
            line-height: 1.2em;
            /* max-height = line-height (1.2) * lines max number (3) */
            max-height: 4.6em;
            /* fix problem when last visible word doesn't adjoin right side  */
            text-align: justify;
            /* place for '...' */
            margin-right: -1em;
            padding-right: 1em;
        }
        /* create the ... */
        .block-with-text:before {
            /* points in the end */
            content: '...';
            /* absolute position */
            position: absolute;
            /* set position to right bottom corner of block */
            right: 0;
            bottom: 0;
        }
        /* hide ... if we have text, which is less than or equal to max lines */
        .block-with-text:after {
            /* points in the end */
            content: '';
            /* absolute position */
            position: absolute;
            /* set position to right bottom corner of text */
            right: 0;
            /* set width and height */
            width: 1em;
            height: 1em;
            margin-top: 0.2em;
            /* bg color = bg color under block */
            background: white;
        }
    </style>
@endsection

@section('content')
    <!-- home-image -->
    <div class="home-image white-text">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-container text-left"><br><br>
                        <div class="inner-text">
                            <h3>{{__('slogan.text')}}</h3>
                            <h2 data-animation-in="zoomIn" class="delay1">
                                <span class="red-color">Cuba</span> Bien Travel</h2>
                            <br>
                            <br>
                            <br>
                            <p class="home-title">{{__('home.home-title')}}</p>
                            {{--<div class="buttons">--}}
                            {{--<a href="#" class="button btn btn-md btn-red radius5 btn-margin-right">Get Started Now </a>--}}
                            {{--<a href="#" class="button btn btn-md btn-outline-dark radius5">Get Started Now </a>--}}
                            {{--</div>--}}
                        </div>
                        <div class="home-bottom">
                            <div class="container-fluid">
                                <div class="col-sm-4 boxes">
                                    <i class="fa fa-life-ring fa-2x"></i>
                                    <h4>{{__('homebox.title-1')}}</h4>
                                    <p>{{__('homebox.content-1')}}</p>
                                </div>
                                <div class="col-sm-4 boxes p-left">
                                    <i class="fa fa-bars fa-2x"></i>
                                    <h4>{{__('homebox.title-2')}}</h4>
                                    <p>{{__('homebox.content-2')}}</p>
                                </div>
                                <div class="col-sm-4 p-left">
                                    <i class="fa fa-coffee fa-2x"></i>
                                    <h4>{{__('homebox.title-3')}}</h4>
                                    <p>{{__('homebox.content-3')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- home image -->

    <section class="text-image creative">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 aos-init aos-animate" data-aos="fade-right">
                    {{--<img src="{{getImageThumbnail('front-1.jpg',640,480, 'fit')}}" class="img-responsive img-relative" alt="">--}}
                    <div id="homeCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($imgs as $img)
                                @if($loop->first)
                                    <li data-target="#homeCarousel" data-slide-to="{!! $loop->index !!}" class="active"></li>
                                @else
                                    <li data-target="#homeCarousel" data-slide-to="{!! $loop->index !!}"></li>
                                @endif
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach($imgs as $img)
                                @if($loop->first)
                                    <div class="item active">
                                        <img src="{{$img}}">
                                    </div>
                                @else
                                    <div class="item">
                                        <img src="{{$img}}">
                                    </div>
                                @endif
                            @endforeach
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
                <div class="col-sm-6" data-aos="fade-left">
                    <div class="title text-left">
                        <h2>
                            <span class="red-color">{{__('word.discover')}}</span> {{__('home.header-1')}}</h2>
                    </div>
                    <div class="text-container">
                        <div class="text">
                            {!! __('home.content-p-1')!!}
                            {{--<div class="buttons">--}}
                            {{--<a href="#" class="button btn btn-md btn-default btn-red radius5 btn-margin-right">Get Started Now </a>--}}
                            {{--<a href="#" class="button btn btn-md btn-default btn-outline-dark radius5 btn-margin-right">Get Started Now </a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- pricing tables - creative -->
    <div class="creative-tables">
        <div class="container">
            <div class="modern-title">
                <div class="col-sm-6">
                    <div class="text-right">
                        <h2>
                            {!! __('home.header-2') !!}
                        </h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-left">
                        <p>{!! __('slogan.text') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($tours as $tour)
                    @if ($loop->first || $loop->iteration % 2 === 0)
                        {{--<div class="row" style="margin-bottom: 80px">--}}
                    @endif
                    <div class="col-lg-6 col-sm-6 col-xs-12" style="margin-bottom: 80px">
                        <div class="tables"
                             data-aos="fade-right" {{$loop->iteration % 2 === 0 ? 'data-aos-delay="'. $loop->index*200 .'"' : ''}}
                        >
                            <div class="table1">
                                <div class="table-header" style="min-height: 80px">
                                    <h2>{{__($tour->nb_trad)}}</h2>
                                </div>
                                <div class="table-body">
                                    <div class="block-with-text">
                                        <p>{!! __($tour->introd_trad) !!}
                                        </p>
                                    </div>
                                    <br>
                                    <a href="{{route('travel_cuba.show',[$tour->id])}}"
                                       class="btn button btn-sm btn-outline-dark radius25">{{__('button.details')}}</a>
                                </div>
                            </div>
                            <div class="table-bg">
                            </div>
                        </div>
                    </div>
                    @if($loop->iteration % 2 === 0)
                        {{--</div>--}}
                        {{--<div class="long-line"></div>--}}
                        {{--<div class="clearfix" style="height: 20px"></div>--}}
                    @endif
                @endforeach
                {{--ver recomendao--}}
                {{--<div class="col-lg-4 col-sm-4 col-xs-12">--}}
                {{--<div class="tables" data-aos="fade-right" data-aos-delay="200">--}}
                {{--<div class="table1">--}}
                {{--<div class="table-header">--}}
                {{--<h3>59.99$</h3>--}}
                {{--<h2>Medium</h2>--}}
                {{--</div>--}}
                {{--<div class="table-body">--}}
                {{--<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their--}}
                {{--default mode--}}
                {{--</p>--}}
                {{--<ul>--}}
                {{--<li>Create and modern designs</li>--}}
                {{--<li>Team that love details</li>--}}
                {{--<li>Unlimited free support</li>--}}
                {{--<li>Create and modern designs</li>--}}
                {{--<li>Unlimited free support</li>--}}
                {{--<li>Unlimited free support</li>--}}
                {{--</ul>--}}
                {{--<br>--}}
                {{--<a href="#" class="btn button btn-sm btn-outline-dark radius25">Get Started Now</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="table-bg recommended">--}}
                {{--<h4>Recommended Plan</h4>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    <!-- pricing tables creative end -->

@endsection

@section('js')
@endsection
