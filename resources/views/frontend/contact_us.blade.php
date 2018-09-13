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
            <iframe width="100%" height="350px;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJgf0RD69C1moR4OeMIXVWBAU&key=AIzaSyDLfbgfkdnJIlxkjEHEaq_iuQ-LrjDJyb4" allowfullscreen></iframe>
        </div>
    </div>
    <!-- contact form end -->
    <!-- section 9 -->
    <section class="section9 contact-form">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <form action="contact.php" method="post" id="contact-form">
                        <div class="messages"></div>
                        <div class="form-group" data-aos="fade-up">
                            <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                        </div>

                        <div class="form-group form_left" data-aos="fade-up" data-aos-delay="100">

                            <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                            <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                            <div class="help-block with-errors"></div>
                            <br>
                            <button class="btn btn-red btn-sm radius25"> <span class="fa fa-envelope"></span> Send your Message </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <div class="title text-left">
                        <h2><span class="red-color">Choose</span> one of our contact forms</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit unde, quae tenetur nam a, explicabo quisquam illo itaque recusandae distinctio.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque itaque dolorem, laudantium vitae ad aliquid dolore corporis maiores unde nisi minima nobis aliquam harum quasi dicta voluptatibus illo placeat neque!</p>
                        <br>
                        <h5><i class="fa fa-envelope fa-xs"></i> E-mail: hello@domain.com</h5>
                        <h5><i class="fa fa-phone fa-xs"></i> Tel: +1 989 6594 66</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section 9 end -->
@endsection

@section('js')
@endsection
