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
    <link rel="stylesheet" href="{{ asset('partials/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('default/icon.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">
    <link rel="stylesheet" href="{{ asset('partials/toast.css') }}">
</head>

<body>
    @include('admin.partials.header')
    <div class="dashboard-main-container">
        @yield('content')
    </div>
</body>
<script src="{{ asset('partials/toast.js') }}"></script>
<script src="{{ asset('partials/modal.js') }}"></script>
<script src="{{ asset('admin/sidebar.js') }}"></script>
</html>
