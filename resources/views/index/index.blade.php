@extends('layouts.user')
@section('title', '控台总览')
@section('content')
<?php $default = '0';?>
<link rel="stylesheet" href="{{ asset('styles/dashboard.css', config('app.secure')) }}">

@if (isset($service_certs['comp_cert']) && $service_certs['comp_cert']!=1)
<div class="alert-message">
    
    <a class="close" href="javascript:void(0);" onclick="$('.alert-message').hide()">忽略</a>
</div>
@endif

<div class="dashboard">
    <ul class="pannel-wrap cf">
        <li>
            <h3>欢迎回来，{{ session('user')['username'] }}</h3>
            
        </li>
        <li>
            <h3>我的产品</h3>
            <div>
                <u class="pannel-icon4 current"><a href="javascript:void(0)">
                    <span class="tips">
                            <span>我的产品</span>
                        </span>
                </a></u>共 <span><?php if(isset($total['acct_balance'])) echo $total['acct_balance']; else echo $default; ?></span> 个
                <a href="{{asset('/products/create', config('app.secure'))}}" class="disabled" >添加产品</a>
            </div>
        </li>
        
        <li>
            <h3>我的测试</h3>
            <div>
                <u class="pannel-icon6 current"><a href="#">
                    <span class="tips">
                            <span>我的测试</span>
                        </span>
                </a></u>共 <span><?php if(isset($total['acct_balance'])) echo $total['acct_balance']; else echo $default; ?></span> 个
                <a href="{{asset('/tests/create', config('app.secure'))}}">添加测试</a>
            </div>
        </li>
    </ul>


    <div class="content-bottom">


        <div class="table-wrap" style="overflow: hidden;" tabindex="0">
            <div class="dashboard-table-title">
                <span class="t1">测试列表</span><!-- 
                <span class="t2"><u></u></span> -->
                <form action="{{url('tests/', [], config('app.secure'))}}" id="dashboard-url">
                {{ csrf_field() }}
                <div class="matrix component-input cf" style="display: inline-block; vertical-align: top; width: 100px; margin-right: 645px; position: absolute; right: 0; top:10px;">
                    <div class="gradient-border">
                        <input type="text" name="bncode" placeholder="批号"> 
                    </div>
                </div>
                <div class="matrix component-input cf" style="display: inline-block; vertical-align: top; width: 200px; margin-right: 435px; position: absolute; right: 0; top:10px; ">
                    <div class="gradient-border">
                        <input type="text" name="cas" placeholder="CAS" disabled=""> 
                    </div>
                </div>
                <div class="matrix component-input cf" style="display: inline-block; vertical-align: top; width: 200px; margin-right: 225px; position: absolute; right: 0; top:10px;">
                    <div class="gradient-border">
                        <input type="text" name="product_name" placeholder="产品名称" value="" disabled="">
                    </div>
                </div>
                <div class="matrix component-datepicker cf" style="display: inline-block; vertical-align: top; width: 200px; margin-right: 15px; position: absolute; right: 0; top:10px;">
                    <div class="gradient-border">
                        <input type="text" placeholder="<?php echo date("Y-m-d",strtotime("-1 month +1 day")); ?>至<?php echo date("Y-m-d",time()); ?>">
                    </div>
                    <input type="hidden" name="startDate" value="<?php echo date("Y-m-d",strtotime("-1 month +1 day")); ?>">
                    <input type="hidden" name="endDate" value="<?php echo date("Y-m-d",time()); ?>">
                </div>
                </form>

            </div>
            <table class="matrix component-table">
                <thead>
                <tr>
                    <th style="width: 30%">检测时间</th>
                    <th style="width: 30%">批次</th>
                    <th style="width: 15%">颜色</th>
                    <th style="width: 15%">纯度(%)</th>
                    <th style="width: 15%">存放条件</th>
                    <!-- <th style="width: 25%">色谱图</th> -->
                    <th style="width: 25%">操作</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>
<?php 
$str = json_encode($data);

?>
<script>
    var G_infodata = <?=$str?>; //console.log(G_infodata)
    var base_url = "{{ asset('', config('app.secure')) }}";
</script>
<script src="{{ asset('js/dashboard.js', config('app.secure')) }}"></script>

@endsection