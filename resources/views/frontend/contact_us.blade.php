@extends('frontend.layout.master')
@section('title','E-SHOP || CONTACT US')
@section('main-content')
<style>
    .contact-us-background{
        background-color: white;
        box-shadow: 0 0 9px grey;
        padding-top: 33px;
        margin-top: -127px;
        border-radius: 30px;
    }
    .h1_heading{
        background-color: #484848;
        background-image: linear-gradient(to right, grey , black);
        color: #ffffff;
        font-family: 'PoppinsRegular';
        text-align: center;
        width: 100%; 
        height: 200px;
        padding-top: 45px;
    }
    .contactus-map{
        border: 0;
        width: 100%;
        margin-top: 75px;
    }
</style>
<div>
    <h1 class="h1_heading">Don't be a stranger just say hello.</h1>
</div>
<div class="page-content">
    <div class="holder mt-0">
        <div class="container contact-us-background">
            <!-- Page Title -->
            <div class="page-title text-center">
                <div class="title">
                    <h1>Contact Us</h1>
                </div>
            </div>
            <!-- /Page Title -->
            <div class="row vert-margin-double justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <h2>Contact us any time for any questions</h2>
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-mobile"></i></div>
                        <div class="contact-info-title">CALL US:</div>
                        <div class="contact-info-text"><span><a href="tel:{{$data->mobile}}" style="text-decoration-line: none;">+91 94294 37405</a></span></div>
                    </div>
                    <!-- <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-clock"></i></div>
                        <div class="contact-info-title">HOURS:</div>
                        <div class="contact-info-text">Mon-fri 9am-8pm sat 9am-6pm</div>
                    </div> -->
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-mail"></i></div>
                        <div class="contact-info-title">E-MAIL:</div>
                        <div class="contact-info-text" style="text-transform: lowercase;"><span><a href="mailto:{{$data->email}}" style="text-decoration-line: none;">{{$data->email}}</a></span></div>
                    </div>
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-location"></i></div>
                        <div class="contact-info-title">ADDRESS:</div>
                        <div class="contact-info-text">{{$data->address}}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 offset-lg-1">
                    <h2 class="text-center">Inquiry Form</h2>
                    <form action="{{ route('addinquiry') }}" method="post" id="contact_form">
                        <div class="form-confirm">
                            <div class="success-confirm text-center">Thanks! Your message has been sent.<br>We will get back to you soon!</div>
                            <div class="error-confirm text-center">Oops! There was an error submitting form.<br>Refresh and send again.</div>
                        </div>
                        @csrf
                        <div class="form-group"><label class="text-dark"><span class="required">*</span>NAME</label> <input type="text" name="name" class="form-control" id="name">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group"><label class="text-dark"><span class="required">*</span>EMAIL</label> <input type="text" name="email" class="form-control" id="email">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group"><label class="text-dark"><span class="required">*</span>MESSAGE</label> <textarea class="form-control textarea--height-100" name="message" id="message" style="width: 360px;"></textarea>
                            <div class="help-block with-errors"></div>
                        </div><button type="submit" class="btn mt-1">send message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>
        <iframe class="contactus-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.931563111125!2d72.85454042886553!3d21.234562240970803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f25b54c7bc5%3A0xbde3ec07a4b68cd5!2sAmby%20Valley%20Heights%20%26%20Arcade!5e0!3m2!1sen!2sin!4v1658309382860!5m2!1sen!2sin" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('frontend/js/inquiry.js')}}"></script>
@endpush