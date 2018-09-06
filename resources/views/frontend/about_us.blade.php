@extends('frontend.layouts.master')

@section('title', __('menu.about_us'))

@section('css')
@endsection

@section('content')
    <!-- header 1 -->
    <div class="header1 about-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="text-container text-left">
                        <h2>{{__('about_us.header-1')}}</h2>
                        <p>{{__('about_us.header-2')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header 1 end -->

    <!-- entry text -->
    <section class="entry-about">
        <div class="container">
            <div class="row">
                <div class="text-container">
                    <div class="title padding">
                        <h2>{!! __('about_us.title-1') !!}</h2>
                        <div class="long-line"></div>
                        <p>{!! __('about_us.content-p-1') !!}</p>
                        <div class="long-line"></div>
                        <p>{!! __('about_us.content-p-2') !!}</p>
                        <div class="long-line"></div>
                        <p>{!! __('about_us.content-p-3') !!}</p>
                        <div class="long-line"></div>
                        <p>{!! __('about_us.content-p-4') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- entry text end -->

    <!-- section start -->
    <section class="timeline">
        <div class="container">
            <div class="row">
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge">1</div>
                        <div class="timeline-panel" data-aos="fade-up">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{!! __('about_us.time-h-1') !!}</h4>
                            </div>
                            <div class="timeline-body">
                                <p>{!! __('about_us.time-p-1') !!}</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge">2</div>
                        <div class="timeline-panel" data-aos="fade-up">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{!! __('about_us.time-h-2') !!}</h4>
                            </div>
                            <div class="timeline-body">
                                <p>{!! __('about_us.time-p-2') !!}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge">3</div>
                        <div class="timeline-panel" data-aos="fade-up">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{!! __('about_us.time-h-3') !!}</h4>
                            </div>
                            <div class="timeline-body">
                                <p>{!! __('about_us.time-p-3') !!}</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge">4</div>
                        <div class="timeline-panel" data-aos="fade-up">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{!! __('about_us.time-h-4') !!}</h4>
                            </div>
                            <div class="timeline-body">
                                <p>{!! __('about_us.time-p-4') !!}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge">5</div>
                        <div class="timeline-panel" data-aos="fade-up">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{!! __('about_us.time-h-5') !!}</h4>
                            </div>
                            <div class="timeline-body">
                                <p>{!! __('about_us.time-p-5') !!}</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge">6</div>
                        <div class="timeline-panel" data-aos="fade-up">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{!! __('about_us.time-h-6') !!}</h4>
                            </div>
                            <div class="timeline-body">
                                <p>{!! __('about_us.time-p-6') !!}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end of section -->
@endsection

@section('js')
@endsection
