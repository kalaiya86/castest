<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>汇付云平台 - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('styles/slide.css', config('app.secure')) }}">
    <script src="{{ asset('js/vendor/jquery.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/main.js', config('app.secure')) }}"></script>
</head>
<body>
<div class="page login">
    <div class="page-wrap">
        <!-- head -->
        <div class="header clearfloat page-inner">
            <div class="inner">
                <div class="header-left clearfloat">
                    <a href="{{ config('app.preurl') }}" class="logo">
                        <img src="{{ asset('images/reg-logo.png', config('app.secure')) }}">
                    </a>
                </div>
            </div>
        </div>
        @yield('content')
        <div class="push"></div>
    </div>
    <!-- footer -->
    <div class="footer clearfloat">
        <div class="footer-title">Copyright2017 ChinaPnR All Right Reserved</div>
    </div>
</div>
</body>
</html>