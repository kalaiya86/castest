@extends('layouts.user')
@section('title', '添加测试')

@section('content')
<?php $path = Request::path(); 
if($path=='tests/create'){
    $action = 'tests';
    $method = 'POST';
}else{
    $action = substr($path, 0, strpos($path,'/edit'));
    $method = 'PUT';
}
?>
<link rel="stylesheet" href="{{ asset('styles/company-certify.css', config('app.secure')) }}">
<form method="{{$method}}" autourl="{{ asset($action, config('app.secure')) }}" action="{{ asset($action, config('app.secure')) }}" enctype="multipart/form-data" id="fm">
    {{ csrf_field() }}
    <div class="company-certify">
        <div class="content-header cf">
            <h2><a href="{{ asset('/', config('app.secure')) }}">返回</a>添加测试</h2>
            <ul class="company-certify-step">
                
                <li class="current"><u>3</u>审核通过，正式使用</li>
            </ul>
        </div>
    <div class="content-bottom">
        <div class="content-group">
            <h2>添加测试</h2>
            @if(isset($certs['comp_cert']))
            <div class="company-certify-alert">
                <h3>审核未通过原因如下：</h3>
                <p><?php echo isset($certs['comp_cert_mark'])?$certs['comp_cert_mark']: ''; ?></p>
            </div>
            @endif
                    
           <!--  <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                <label for="">批号：</label>
                <div class="gradient-border">
                    <input name="bncode" maxlength="50" placeholder="请输入批号" value="{{ $info['bncode'] or '' }}" type="text">
                </div>
                <div class="error-tip"><u></u><span>错误</span></div>
            </div> -->
            <!-- <div class="matrix component-select has-label cf" style="margin-bottom: 30px;">
                <label for="">批号：</label>
                <div class="gradient-border">
                    <select  name="bncode" class="select">
                        <option value="">请选择批号</option>
                        @if(isset($bncodes))
                        @foreach($bncodes as $key=>$value)
                        <option value="{{$key}}" {{ isset($info['bncode'])&&$info['bncode']==$key ?'selected': '' }}>{{$value}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="error-tip"><u></u><span>错误</span></div>
            </div> -->

            <div class="matrix component-select has-label cf" style="margin-bottom: 30px;">
                <label for="">批号：</label>
                <div class="gradient-border">
                    <select  name="bncode" class="select">
                        <option value="">请选择产品</option>
                        @if(isset($products))
                        @foreach($products as $key=>$value)
                        <option value="{{$value->bncode}}" {{ isset($info['bncode'])&&$info['bncode']==$value->bncode ?'selected': '' }}>{{$value->cas.'-'.$value->product_cname}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="error-tip"><u></u><span>错误</span></div>
            </div>

            <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                <label for="">外观：</label>
                <div class="gradient-border">
                    <input name="appearance" placeholder="请输入外观" value="{{ $info['appearance'] or '' }}" type="text">
                </div>
                <div class="error-tip"><u></u><span>错误</span></div>
            </div>

            
            <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                <label for="">存放条件：</label>
                <div class="gradient-border">
                    <input name="condition" maxlength="50" placeholder="请输入存放条件" value="{{ $info['condition'] or '' }}" type="text">
                </div>
                <div class="error-tip"><u></u><span>错误</span></div>
            </div>
            

                <div class="matrix component-input has-label cf" style="margin-bottom: 30px;">
                    <label for="">纯度：</label>
                    <div class="gradient-border">
                        <input name="purity" maxlength="30" placeholder="请输入纯度" value="{{ $info['purity'] or '' }}" type="text">
                    </div>
                    <div class="error-tip"><u></u><span>错误</span></div>
                </div>

                <div class="matrix component-datepicker component-datepicker-single has-label cf" style="margin-bottom: 30px;">
                    <label for="">测试时间：</label>
                    <div class="gradient-border">
                        <input name="test_time" readonly="readonly" placeholder="请输入测试时间" value="{{  $info['test_time'] or date('Y-m-d H:m:s') }}" type="text">
                    </div>
                    <div class="error-tip"><u></u><span>错误</span></div>
                </div>

                <div class="matrix component-photo-upload has-label cf" style="margin-bottom: 30px;">
                    <label for="">色谱图：</label>
                    <div class="component-photo-upload-inner">
                        <div class="upload-wrap {{ !empty($info['spectrogram']) ? 'has-file is-img' : '' }}">
                            <input class="file-class need-valid" name="spectrogram" value="{{  $info['spectrogram'] or '' }}" type="hidden"> <!--如果图片已经存在-->
                            <input type="file"  is-pdf="true" photo-name="spectrogram" class="photo-upload" url="{{ asset('/index/fileUpload', config('app.secure')) }}">
                            <img src="{{  $info['spectrogram'] or '' }}" alt="" class="image-bg">
                            <!--加载动画-->
                            <div class="la-ball-clip-rotate la-2x">
                                <div></div>
                            </div>
                            <!--加载动画-->

                            <!--交互遮罩-->
                            <div class="upload-mask">
                                <a href="javascript:void(0);" class="file-del">删除</a>
                                <a href="javascript:void(0);" class="file-show">点击查看大图</a>
                            </div>
                            <!--交互遮罩-->
                        </div>
                        
                        <p>请提供色谱图，格式要求jpg、png、pdf不超过5MB</p>
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
    var list_url = "{{ asset('/', config('app.secure')) }}";
</script>
<script src="{{ asset('js/company-certify.js', config('app.secure')) }}"></script>

@endsection