@extends('master')

@section('title','订单提交')
<link rel="stylesheet" href="/css/lunbotu.css" />
@section('content')
<section class="page1">
<div class="weui-cells__title">订单列表</div>
        <div class="weui-cells weui-cells_checkbox">
        @if($cart_items!=null&&$cart_items!='')
        @foreach($cart_items as $cart_item)
                <div class="weui_cell_bd weui_cell_primary" style="margin-top:30px;">
                    <div style="position:relative; width:100%; padding:5px" >
                        <img src="{{$cart_item->product->preview}}" class="bk_preview1">
                        <div style="position:absolute; left:100px;right:0;top:0; width:50em;">
                        <p style="width:50em; font-size:14px" id="name">{{$cart_item->product->name}}</p>
                          <p class="bk_time1" style="margin-top:15px; color:red">
                            <span>{{$cart_item->product->price}}</span>
                            <span class="bk_summary">×</span>
                            <span>{{$cart_item->count}}</span>
                          </p>
                        </div>
                    </div>
                </div>
        @endforeach    
        @endif   
    <div class="weui-cells__title">选择支付方式</div>
    <div class="weui-cells">
    <div class="weui-cell weui-cell_select">
        <div class="weui-cell__bd">
            <select class="weui-select" name="select1" id="weui-select">
                <option selected="" value="1">支付宝</option>
                <option selected="" value="2">微信</option>
            </select>
        </div>
    </div>
    </div>
    <div class="weui-cells__title">填写收货信息</div>
        <div class="weui-cells weui-cells_checkbox">
  
    <div class="weui-cells__title"></div>
        <div class="weui-cell">
        <div class="weui-cell__bd">
            收件人：<span style="float:right;margin-right:10px;color:red; font-weight:bold"><input type="text" name="names" value="" id="names" style="height:25px;width:250px;"></span>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            电话号码：<span style="float:right;margin-right:10px;color:red; font-weight:bold"><input type="text" name="tel" value="" id="tel"  style="height:25px;width:250px;"></span>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            详细地址：<span style="float:right;margin-right:10px;color:red; font-weight:bold"><input type="text" name="address" value=""  id="address" style="height:25px;width:250px"></span>
        </div>
    </div>
 
    </div>
</div>  

</div>  
    <div class="weui-cells__title"></div>
    <div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            总计：<span style="float:right;margin-right:10px;color:red; font-weight:bold">¥  {{$total_price}}</span>
        </div>
    </div>
</div> 
    <div class="bk_btn3">
        <a href="javascript:;"  onclick="order_list()" class="weui-btn weui-btn_primary" >提交订单</a>
    </div>
</div>
</section>
@endsection

@section('my-js')
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" charset="utf-8"></script>
<script type="text/javascript">
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '', // 必填，公众号的唯一标识
        timestamp: , // 必填，生成签名的时间戳
        nonceStr: '', // 必填，生成签名的随机串
        signature: '',// 必填，签名
        jsApiList: ['chooseWXPay'] // 必填，需要使用的JS接口列表
    });
    wx.ready(function(){
        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
    });
    wx.error(function(res){
        // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
    });
function order_list(){
    let ids=[];
    @foreach($product_ids as $pro)
        ids.push({{$pro}});
    @endforeach
    //location.href="/order_list/"+ids;
    var tel=$('#tel').val();
    var names=$('#names').val();
    var payway=$('#weui-select').val();
    var address=$('#address').val();
    var total_price="{{$total_price}}";
    $.ajax({
           url: '/order_address/'+ids,
           type: 'POST',
           dataType: 'json',
           data: {
                  tel:tel,
                  names:names,
                  total_price:total_price,
                    payway:payway,
                    address:address,
                    _token:"{{csrf_token()}}"},
                    success:function(data){
                    if(data==null){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("服务器端错误!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                        return;
                    }
                    if(data==1){
                        alert('请认真填写收货信息');
                        return;
                    }
                    console.log(data);
                    location.href="/order_list";
                    }               
       });        
}

</script>
   
@endsection
