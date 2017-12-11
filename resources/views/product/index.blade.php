@extends('layouts.user')
@section('title', '产品中心')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/company-certify.css', config('app.secure')) }}">

<div id="detail" >
    
    
    <div class="company-certify">
        <div class="content-header cf"  style="margin-bottom: 30px;">
            <h2><a href="javascript:history.go(-1)">返回</a>
                产品中心
            </h2>
            <ul class="company-certify-step">
                
                <li class="current"><u>&nbsp;</u><a href="{{ asset('products/create', config('app.secure')) }}">添加产品</a></li>
            </ul>
        </div>
        <!--header-end-->

        <form method="POST" id="fm" request-url="{{url('/products', [], config('app.secure'))}}">
            {{ csrf_field() }}
            
            <input  value="{{$total or 0}}" name="total" id="total" type="hidden">
            <div class="content-middle cf" style="text-align: left">
                <div class="wrap-item w-25">
                    <div class="matrix component-select has-label cf">
                        <label for="" >产品批号：</label>
                        <div class="gradient-border">
                            <select class="select"  name="bncode" placeholder="请选择产品批号">
                                <option value="">全部</option>
                                @if(isset($bncodes))
                                @foreach($bncodes as $k => $v)
                                <option value="{{$v['bncode']}}">{{$v['bncode']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="wrap-item w-25">
                    <div class="matrix component-select has-label cf">
                        <label for="" >CAS：</label>
                        <div class="gradient-border">
                            <select class="select"  name="cas" placeholder="请选择CAS">
                                <option value="">全 部</option>
                                @if(isset($cases))
                                @foreach($cases as $k => $v)
                                <option value="{{$v['cas']}}">{{$v['cas']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="wrap-item w-25">
                    <div class="matrix component-select has-label cf required">
                        <label for="">中文名称：</label>
                        <div class="gradient-border">
                            <select class="select"  name="product_cname" placeholder="请选择中文名称">
                                <option value="">全部</option>
                                @if(isset($names))
                                @foreach($names as $k => $v)
                                <option value="{{$v['product_cname']}}">{{$v['product_cname']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        
                    </div>
                </div>

                <div class="wrap-item w-25">
                    <div class="matrix component-btn has-caption cf">
                        <div class="gradient-border">
                            <button type="button"  id="company-certify-submit">查询</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--middle-end-->

        <div class="content-bottom" style="padding: 0">
            <div class="table-wrap" style="overflow: hidden;" tabindex="0">
                
            </div>  <!--这里一层是新增的-->

            <div class="table-pager m-pagination" request-url="{{url('/products', [], config('app.secure'))}}">
                
            </div>
        </div>
        <!--bottom-end-->
    </div>
</div>


<script>
    var base_url = "{{ asset('/product', config('app.secure')) }}";
</script>
<script src="{{ asset('js/product.js', config('app.secure')) }}"></script>
@endsection