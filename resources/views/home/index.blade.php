@extends('home.partials.main')
@section('title','Medusa Vaccination System (MVS)')

@section('content')
    <div class="container video-container">
        <video loop autoplay muted>
            <source src="{{ asset('default/background video.mp4') }}" type="video/mp4">
        </video>
        <div class="content">
            <small>shaping tomorrow's health</small>
            <h1>Built to redefine vaccination</h1>
            <h1> through intelligent life saving innovation</h1>
        </div>
        <i class="material-icons arrow-down x3">keyboard_arrow_down</i>
        <i class="material-icons arrow-down x2">keyboard_arrow_down</i>
        <i class="material-icons arrow-down">keyboard_arrow_down</i>
        <div class="vignette"></div>
        <div class="vignette"></div>
    </div>

    <div class="container mission">
        <div class="star-wrapper">
            <div class="content">
                <small>our mission</small>
                <h1>To Advance Immunization</h1>
                <h1>Right Vaccines Right Hospitals <br>
                    Right Managers Right Parents</h1>
            </div>
            <svg id="pathSvg" viewBox="0 0 200 200">
                <path class="theLine"
                    d="M100,10 L120,75 L190,75 L135,115 L155,180 L100,140 L45,180 L65,115 L10,75 L80,75 Z" />
            </svg>
        </div>
    </div>

    <div class="container swiper">
        <div class="content">
            <small>together we protect what matters most</small>
            <h1>Because Their Tomorrow</h1>
            <h1>Starts With Care Today</h1>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="{{ asset('pictures/1.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/2.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/3.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/4.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/5.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/6.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/7.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/8.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/9.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/10.jpg') }}" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container cta">
        <div class="content">
            <small>contact us</small>
            <h1>Strengthen Immunization</h1>
            <h1>Hospitals and Healthcare Leaders Welcome</h1>
            <p>
                Join us in improving child healthcare through smart vaccine access and digital innovation. Help us build a
                future where every child is protected.
            </p>
            <a href="">
                <button class="btn">
                    Contact Now
                    <i class="material-icons">north_east</i>

                </button>
            </a>
        </div>
        <div class="medias">
            <div class="media">
                <img src="https://pngimg.com/uploads/virus/virus_PNG52.png" alt="">
            </div>
            <div class="media">
                <img src="https://pngimg.com/uploads/virus/virus_PNG52.png" class="main-virus-img" alt="">
            </div>
            <div class="media">
                <img src="https://pngimg.com/uploads/virus/virus_PNG52.png" alt="">
            </div>
        </div>
    </div>
@endsection
