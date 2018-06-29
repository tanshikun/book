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
                        <p style="width:50em; font-size:14px">{{$cart_item->product->name}}</p>
                        <p class="bk_time1" style="margin-top:15px; color:red">{{$cart_item->product->price}}<span class="bk_summary">×</span>{{$cart_item->count}}</p>
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

<script type="text/javascript">

function order_list(){
    let ids=[];
    @foreach($product_ids as $pro)
        ids.push({{$pro}});
    @endforeach
    //location.href="/order_list/"+ids;
    var tel=$('#tel').val();
    var name=$('#names').val();
    var payway=$('#weui-select').val();
    var address=$('#address').val();
    $.ajax({
           url: '/order_address',
           type: 'POST',
           dataType: 'json',
           data: {name:name,
                  tel:tel,
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
                    if(data.status!=0){
                        
                    }
                    location.href="/order_list/"+ids;
                } 
       })

          
}

</script>
   
@endsection
