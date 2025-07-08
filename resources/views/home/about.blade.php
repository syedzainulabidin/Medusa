@extends('home.partials.main')
@section('title','About us - Medusa Vaccination System (MVS)')
@section('content')
    <div class="container about">
        <div class="content">
            <small>be part of the solution</small>
            <h1>Transforming child health</h1>
            <h1>through smart vaccination</h1>
            <small>1 in every 5 children misses a critical vaccine. Let’s change that together.</small>
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/5SproXmRUkI?si=XQC4ripC_aZB6dVx"
                frameborder="0"></iframe>
        </div>
        <span class="material-symbols-outlined arrow-down">
            menu
        </span>
    </div>

    <div class="container team">
        <div class="content">
            <small>team</small>
            <h1>Where collaboration meets care</h1>
            <p>Our team brings together experts from diverse fields — including public health, pediatric care, software
                engineering, immunization strategy, and digital innovation — all dedicated to reimagining how vaccinations
                are delivered and managed for every child.</p>
        </div>
        <div class="spline-3d-globe">
            <iframe src='https://my.spline.design/untitled-bZISuZvti2wrG2L97eIsjSbi/' frameborder='0' width='100%'
                height='100%'></iframe>
        </div>
        <div class="watermark-hider"></div>
    </div>
    <div class="container swiper">
        <div class="content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="{{ asset('pictures/11.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/12.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/13.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/14.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/15.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/16.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/17.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/18.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/19.jpg') }}" alt="" srcset=""></div>
                    <div class="swiper-slide"><img src="{{ asset('pictures/20.jpg') }}" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
