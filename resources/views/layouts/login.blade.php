<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>汇付云平台 - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('styles/index.css', config('app.secure')) }}">
    <style>
        body{
            background: url('{{ asset('images/login-bg.jpg', config('app.secure')) }}') 20% 50% no-repeat #fff ;
            overflow: hidden;
        }
    </style>

    <script src="{{ asset('js/vendor/jquery.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/dialog.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/login.js', config('app.secure')) }}"></script>
</head>
<body>
    @yield('content')
</body>
</html>