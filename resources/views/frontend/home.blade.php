@extends('frontend.layouts.master')

@section('title', __('menu.home'))

@section('css')
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
                    <img src="{{assets_frontend('images/front-1.jpg')}}" class="img-responsive img-relative" alt="">
                </div>
                <div class="col-sm-6">
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

@endsection

@section('js')
@endsection
