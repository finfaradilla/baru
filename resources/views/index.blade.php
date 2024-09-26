@extends('layouts.main')

@section('container')
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="home" class="hero-area bg_cover">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 offset-xl-7 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="hero-content">
                        <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">Room Reservation
                        </h2>
                        <!-- <p class="wow fadeInUp" data-wow-delay=".4s">Welcome to this website.</p> -->
                        <div class="hero-btns">
                            <a href="/daftarruang" class="main-btn wow fadeInUp" data-wow-delay=".6s">Book a room</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-left">
            <img src="assets/images/AMYLA-11.jpg" alt="">
            <img src="assets/images/dot-shape.svg" alt="" class="shape">
        </div>
    </section>
@endsection
