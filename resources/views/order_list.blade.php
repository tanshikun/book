@extends('master')

@section('title','订单列表')
<link rel="stylesheet" href="/css/lunbotu.css" />
@section('content')
<section class="page1">
@if($orders!=null&&$orders!='')
     @foreach($orders as $key=> $order)
     <div class="page__bd" style="border-top:2px solid #cccccc;border-bottom:2px solid #cccccc;margin-bottom:20px">
        <div class="weui-cells__title">
            <span>订单号：{{$order->order_no}}</span>
            <span style="float:right;margin-right:10px;color:red;width:100%-10px">未支付</span>
        </div>
        <div class="weui-cells__title">
            <span>订单金额</span>
            <span style="float:right;margin-right:10px;color:red;width:100%-10px">{{$order->total_price}}</span>
        </div>
        <div class="weui-cells__title">
            <span>订单提交时间</span>
            <span style="float:right;margin-right:10px;color:red;width:100%-10px">2018-12-30 08:22:18</span>
        </div>
        <div class="weui-cells__title" style="height:100px">
            <span>发货信息</span>
            <span style="float:right;margin-right:10px;width:100%-10px">
                <p>张三&nbsp;&nbsp;&nbsp;&nbsp;18911111111</p>
                <p>湖北省巴东县叶桑正</p>
            </span>
        </div>
            @foreach($order->order_items as $order_item) 
                <div class="weui-form-preview__bd">
                    <p>
                        <label class="weui-form-preview__label">商品</label>
                        <span class="weui-form-preview__value">{{$order_item->product->name}}</span>
                    </p>
                    <p>
                        <label class="weui-form-preview__label">单价</label>
                        <span class="weui-form-preview__value">{{$order_item->product->price}}</span>
                    </p>
                    <p>
                        <label class="weui-form-preview__label">件数</label>
                        <span class="weui-form-preview__value">×{{$order_item->count}}</span>
                    </p>
                </div>
                @endforeach
               
                <div class="weui-form-preview__ft">
                <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">取消订单</a>
                <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">立即支付</button>
            </div>
                </div>
    @endforeach                      
 @endif
</section>

@endsection

@section('my-js')

<script type="text/javascript">
//function order_list(){
//   location.href="/order_list/"+;
//}
</script>
   
@endsection
