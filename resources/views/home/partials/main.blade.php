<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('universal/style.css') }}">
    <link rel="stylesheet" href="{{ asset('default/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('default/icon.jpg') }}" type="image/x-icon">
</head>

<body>
    @include('home.partials.header')
    @yield('content')
    @include('home.partials.footer')
</body>
<!-- GSAP Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/MotionPathPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/InertiaPlugin.min.js"
    integrity="sha512-PEhxb+AivyFXL3zZnE/TwS4sgWRDZRF7aTGVGkiF7ej++sMKTtN+ZfrEo8lPxrfMIOws/1RkVc1Apua29ktRwg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/Draggable.min.js"
    integrity="sha512-dgqdovLK5r/NMiV5YfWA0xC94DKGrm+6q1OZpuWHm+uBGLTck6wu58WAX9lmy8wec6cVnsgxbPJ60DtmNFnfgg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('user/app.js') }}"></script>
<script src="{{ asset('auth/app.js') }}"></script>
<script src="{{ asset('default/app.js') }}"></script>

</html>
