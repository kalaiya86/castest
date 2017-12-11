@extends('layouts.user')
<?php $path = Request::path(); 
if($path=='products/create'){
    $action = 'products';
    $method = 'POST';
    $name = '添加';
}else{
    $action = substr($path, 0, strpos($path,'/edit'));
    $method = 'PUT';
    $name = '编辑';
}
?>
@section('title', $name.'产品')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/company-certify.css', config('app.secure')) }}">
<form method="{{$method}}" autourl="{{ asset($action, config('app.secure')) }}" action="{{ asset($action, config('app.secure')) }}" enctype="multipart/form-data" id="fm">
    {{ csrf_field() }}
    <div class="company-certify">
        <div class="content-header cf">
            <h2><a href="{{ asset('/', config('app.secure')) }}">返回</a>{{$name.'产品'}}</h2>
            <!-- <ul class="company-certify-step">
                
                <li class="current"><u>3</u>审核通过，正式使用</li>
            </ul> -->
        </div>
        <div class="content-bottom">
            <div class="content-group">
                <h2>{{$name.'产品'}}</h2>
                @if(isset($certs['comp_cert']))
                <div class="company-certify-alert">
                    <h3>审核未通过原因如下：</h3>
                    <p><?php echo isset($certs['comp_cert_mark'])?$certs['comp_cert_mark']: ''; ?></p>
                </div>
                @endif
                        
                <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                    <label for="">CF编号：</label>
                    <div class="gradient-border">
                        <input name="cfnum" maxlength="50" placeholder="请输入CF编号" value="{{ $info['cfnum'] or '' }}" type="text">
                    </div>
                    <div class="error-tip"><u></u><span>错误</span></div>
                </div>
                <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                    <label for="">批号：</label>
                    <div class="gradient-border">
                        <input name="bncode" maxlength="50" placeholder="请输入批号" value="{{ $info['bncode'] or '' }}" type="text">
                    </div>
                    <div class="error-tip"><u></u><span>错误</span></div>
                </div>
                <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                    <label for="">C.A.S：</label>
                    <div class="gradient-border">
                        <input name="cas" placeholder="请输入C.A.S" value="{{ $info['cas'] or '' }}" type="text">
                    </div>
                    <div class="error-tip"><u></u><span>错误</span></div>
                </div>

                <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                    <label for="">产品中文名称：</label>
                    <div class="gradient-border">
                        <input name="product_cname" maxlength="50" placeholder="请输入产品中文名称" value="{{ $info['product_cname'] or '' }}" type="text">
                    </div>
                    <div class="error-tip"><u></u><span>错误</span></div>
                </div>
                <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                    <label for="">产品英文名称：</label>
                    <div class="gradient-border">
                        <input name="product_ename" maxlength="50" placeholder="请输入产品英文名称" value="{{ $info['product_ename'] or '' }}" type="text">
                    </div>
                    <div class="error-tip"><u></u><span>错误</span></div>
                </div>
                    
            </div>


            <div class="matrix component-btn cf" style="margin-bottom: 30px; margin-left: 35px">
                        <label for=""></label>
                        <div class="gradient-border" style="width: auto; margin-top: 0px;">
                            <button type="button" id="company-certify-submit">提交审核</button>
                        </div>
            </div>
        </div>
    </div>
</form>
<script>
    var list_url = "{{ asset('/product', config('app.secure')) }}";
</script>
<script src="{{ asset('js/company-certify.js', config('app.secure')) }}"></script>

@endsection