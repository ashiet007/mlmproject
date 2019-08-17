@extends('layouts.app')
@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Contact Us</a></li>
                        <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                    </ul>
                    <p class="text-lighten">Do you have other questions? Don't worry, there aren't any dumb questions. Just fill out the form below and we'll get back to you as soon as possible.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- contact -->
    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title">Contact Us</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <form action="{{route('contact.storeQuery')}}" method="post">
                        @csrf
                        <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Your Name">
                        <input type="email" class="form-control mb-3" id="mail" name="email" placeholder="Your Email">
                        <input type="text" class="form-control mb-3" id="subject" name="subject" placeholder="Subject">
                        <textarea name="message" id="message" class="form-control mb-3" placeholder="Your Message"></textarea>
                        <button type="submit" value="send" class="btn btn-primary">SEND MESSAGE</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <a href="#" class="text-color h5 d-block"><h3><i class="fa fa-phone-square fa-2x" aria-hidden="true"></i> Coming Soon</h3></a>
                    <a href="mailto:modinaamaindia@gmail.com" class="text-color h5 d-block"><h3><i class="fa fa-envelope fa-2x" aria-hidden="true"></i> modinaamaindia@gmail.com</h3></a>
                    <a href="{{url('/')}}" class="text-color h5 d-block"><h3><i class="fa fa-globe fa-2x" aria-hidden="true"></i> www.modinaama.in</h3></a>
                </div>
            </div>
        </div>
    </section>
    <!-- /contact -->

    <!-- gmap -->
    <section class="section pt-0 pb-0">
        <!-- Google Map -->
        <div id="map_canvas" data-latitude="51.507351" data-longitude="-0.127758"></div>
    </section>
    <!-- /gmap -->
@endsection