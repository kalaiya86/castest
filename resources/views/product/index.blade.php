@extends('layouts.user')
@section('title', '企业认证')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/company-certify.css', config('app.secure')) }}">

<!-- <form method="post" action="" id="fm"> -->
    <div class="company-certify">
        <div class="content-header cf"  style="margin-bottom: 30px;">
            <h2><!--<a href="javascript:history.go(-1)">返回</a>-->
                产品批次
            </h2>
            <!--<ul class="company-certify-step">
                <li class="current"><u>1</u>填写认证信息</li>
                <li class=""><u>2</u>人工审核</li>
                <li class=""><u>3</u>认证结果</li>
            </ul>-->
        </div>
        <!--header-end-->

        <form action="{{url('products/', [], config('app.secure'))}}" method="POST" id="form01">
            <div class="content-middle cf" style="text-align: left">
                <!-- <div class="wrap-item w-25">
                    <div class="matrix component-select has-label cf">
                        <label for="" >批号：</label>
                        <div class="gradient-border">
                            <select class="select"  name="bncode" placeholder="请选择交易类型">
                                <option value="0">充值</option>
                                <option value="1">消费</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="wrap-item w-25">
                    <div class="matrix component-select has-label cf">
                        <label for="" >交易方式：</label>
                        <div class="gradient-border">
                            <select class="select"  name="bbb" placeholder="请选择交易方式">
                                <option value="0">全部</option>
                                <option value="1">支付宝</option>
                                <option value="2">微信</option>
                                <option value="3">银联</option>
                            </select>
                        </div>
                    </div>
                </div> -->

                <div class="wrap-item w-25">
                    <div class="matrix component-datepicker has-label cf required">
                        <label for="">请选择时间段：</label>
                        <div class="gradient-border">
                            <input type="text" placeholder="请选择时间段">
                        </div>
                        <input type="hidden" name="acct_date[]" value="2017-09-19">
                        <input type="hidden" name="acct_date[]" value="2017-10-19">
                    </div>
                </div>

                <div class="wrap-item w-25">
                    <div class="matrix component-btn has-caption cf">
                        <div class="gradient-border">
                            <button type="button" id="company-certify-submit">查询</button>
                        </div>
                    </div>
                </div>
                <input name="id" value="2" type="hidden">

            </div>
        </form>
        <!--middle-end-->

        <div class="content-bottom" style="padding: 0">
            <div class="table-wrap" style="overflow: hidden;" tabindex="0">
                <table class="matrix component-table">
                    <thead>
                    <tr>
                        <th>操作时间</th>
                        <th>交易类型</th>
                        <th>交易方式</th>
                        <th>收支（元）</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="">2017-01-27 11:32:26</td>
                        <td class="">充值</td>
                        <td class="">支付宝</td>
                        <td class="">+56,000.00</td>
                    </tr>
                    
                    </tbody>
                </table>
            </div>  <!--这里一层是新增的-->

            <div class="table-pager m-pagination" style="display: block">
                这里是分页，js生成
            </div>
        </div>
        <!--bottom-end-->
    </div>
<!-- </form> -->
<script src="{{ asset('js/finance.js', config('app.secure')) }}"></script>
@endsection