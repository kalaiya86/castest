<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>再启 - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('styles/index.css', config('app.secure')) }}">
    <link rel="stylesheet" href="{{ asset('styles/selectize.css', config('app.secure')) }}">
    <link rel="stylesheet" href="{{ asset('styles/daterangepicker.css', config('app.secure')) }}">
    <link rel="stylesheet" href="{{ asset('styles/jquery.pagination.css', config('app.secure')) }}">
    <link rel="stylesheet" href="{{ asset('styles/jquery-ui.css', config('app.secure')) }}">
    <link rel="stylesheet" href="{{ asset('styles/dialog.css', config('app.secure')) }}">
    <link rel="stylesheet" href="{{ asset('styles/realme.css', config('app.secure')) }}">
    <link rel="stylesheet" href="{{ asset('styles/bootstrap-datetimepicker.css', config('app.secure')) }}">
    <script src="{{ asset('js/vendor/jquery.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/moment.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/moment-locale.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/bootstrap-datetimepicker.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/jquery.daterangepicker.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/selectize.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/jquery.pagination.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/dialog.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/jquery.nicescroll.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/jquery.transit.min.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/ajaxsubmit.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/vendor/compress.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/index.js', config('app.secure')) }}"></script>
    <script src="{{ asset('js/realme.js', config('app.secure')) }}"></script>
</head>
<body>
<div class="wrap">
<?php $users = session('user');?>
    @section('sidebar')
        <div class="top-bar">
            <a href="{{url('realme/demo/index', [], config('app.secure'))}}"><div class="logo">测试平台</div></a>
            <div class="user-info">
                <img src="{{ asset('images/user_icon.jpg', config('app.secure')) }}" alt="">
                <ul>
                    <li>{{ $users['username'] }}</li>
                    <li><u class="pannel-icon-logout current"></u><a href="{{ asset('index/logout', config('app.secure')) }}">退出</a></li>
                </ul>
            </div>
        </div> 
        <button type="button" class="btn-menu" onclick=""><!--主菜单--></button>

        <ul class="menu"> <!--主菜单图表及提示-->
            <li><span>控台总览</span></li>
            <li><span>添加测试</span></li>
            <!-- <li><span>产品服务</span></li> -->
            
        </ul>

        <?php $path = Request::path(); ?>
        <ul class="sub-menu"> <!--子菜单,数量和主菜单一一对应-->
            <li>
                <dl>
                    <dd><div class="gradient-border {{ $path == '/' ? 'current' : '' }}"><a href="{{ asset('/', config('app.secure')) }}">控台总览</a></div></dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dd><div class="gradient-border {{ $path == 'tests/create' ? 'current' : '' }}"><a href="{{ asset('tests/create', config('app.secure')) }}">添加测试</a></div></dd>
                </dl>
            </li>
            
            <!-- <li>
                <dl>
                    <dd><div class="gradient-border {{ $path == 'realme/application/index' ? 'current' : '' }}"><a href="{{ asset('realme/application/index', config('app.secure')) }}">财务中心</a></div></dd>
                </dl>
            </li> -->
        </ul>
    @show

    <div id="realme" class="content-wrap" style="text-align: center">
        
        @yield('content')
    </div>
</div>
</body>
</html>