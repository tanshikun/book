@extends('master')

@section('title','订单列表')
<link rel="stylesheet" href="/css/lunbotu.css" />
@section('content')
<section class="page1">
@if(isset($orders))
     @foreach($orders as $order)
     <div class="page__bd" style="border-top:2px solid #cccccc;border-bottom:2px solid #cccccc;margin-bottom:20px">
        <div class="weui-cells__title">
            <span>订单号：{{$order->order_no}}</span>
            @if($order->status==0)
                <span style="float:right;margin-right:10px;color:red;width:100%-10px">待支付</span>
            @endif
            @if($order->status==2)
                <span style="float:right;margin-right:10px;color:red;width:100%-10px">待发货</span>
            @endif
            @if($order->status==3)
                <span style="float:right;margin-right:10px;color:red;width:100%-10px">已发货</span>
            @endif
            @if($order->status==4)
                <span style="float:right;margin-right:10px;color:red;width:100%-10px">交易完成</span>
            @endif
        </div>
        <div class="weui-cells__title">
            <span>订单金额</span>
            <span style="float:right;margin-right:10px;color:red;width:100%-10px">{{$order->total_price}}</span>
        </div>
        <div class="weui-cells__title">
            <span>订单提交时间</span>
            <span style="float:right;margin-right:10px;color:red;width:100%-10px">{{$order->created_at}}</span>
        </div>
        <div class="weui-cells__title" style="height:100px">
            <span>发货信息</span>
            <span style="float:right;margin-right:10px;width:100%-10px">
                <p>{{$order->names}}&nbsp;&nbsp;&nbsp;&nbsp;{{$order->tel}}</p>
                <p>{{$order->address}}</p>
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
                @if($order->status!=0)
                <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:" onclick="order_cancel()">申请退货</a>
                <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:" onclick="look()">查看订单</button>
                @else
                <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:" onclick="order_cancel()">取消订单</a>
                <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:" onclick="pay()">立即支付</button>
                @endif
            </div>
                </div>
    @endforeach 
    <script type="text/javascript">
        function order_cancel(){
            var order_no="{{$order->order_no}}";
            $.ajax({
                url: '/order_cancel/'+order_no,
                type: 'POST',
                dataType: 'json',
                data: {order_no:order_no,_token:"{{csrf_token()}}"},
                success:function(data){
                    if(data==2){
                        alert('取消成功');
                        location.reload();
                    }
                    if(data!=2){
                        alert('取消失败');
                        return;
                    }
                }
    });
    
}
</script> 
@else
        <div class="weui-cells__title" style="margin:0 auto;">
            <span>这里什么也没有~~</span>
        </div>            
 @endif
</section>

@endsection

@section('my-js')


   
@endsection
