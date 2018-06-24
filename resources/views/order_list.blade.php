@extends('master')

@section('title','订单列表')
<link rel="stylesheet" href="/css/lunbotu.css" />
@section('content')
<section class="page1">
@if($orders!=null&&$orders!='')
 @foreach($orders as $key=> $order)

        <div class="weui-cells__title">
            <span>订单号：{{$order->order_no}}</span>
            <span style="float:right;margin-right:10px;color:red;width:100%-10px">未支付</span>
        </div>
       
            @foreach($order->order_items as $order_item) 
    
                <div class="weui_cell_bd weui_cell_primary" style="margin-top:30px;">
                    <div style="position:relative; width:100%; padding:5px" >
                        <img src="{{$order_item->product->preview}}" class="bk_preview1">
                        <div style="position:absolute; left:100px;right:0;top:0; width:50em;">
                        <p style="width:50em; font-size:14px">{{$order_item->product->name}}</p>
                        <p class="bk_time1" style="margin-top:15px; color:red">{{$order_item->product->price}}<span class="bk_summary">×</span>{{$order_item->count}}</p>
                        </div>
                    </div>
                </div>
            @endforeach    

                        <div class="weui_cell_bd weui_cell_primary" style="margin-top:10px;text-align:right;margin-right:10px;font-size:14px;width:100%-10px">
                            共计{{$total_count}}件，合计： <span>{{$order->total_price}}</span>
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
