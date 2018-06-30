@extends('admin.master')
<style>
    .left{
        text-align: left;
        font-size: 14px;
        margin-left: 10px;
    }
</style>
@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
            <tr class="text-c">
                <th width="150">类别</th>
                <th width="450">订单详情</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-c">
                <td width="150">ID</td>
                <td width="300" class="left">{{$orders->id}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">会员号</td>
                <td width="300" class="left">
                    @if($members->email!=null&&$members->email)
                    {{$members->email}}
                    @else{{$members->phone}}
                    @endif
                </td> 
            </tr>
            <tr class="text-c">
                <td width="150">订单号</td>
                <td width="300" class="left">{{$orders->order_no}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">购买商品</td>
                <td width="300" class="left">
                    @foreach($order_items as $order_item)
                        <p><span>《{{$order_item->product->name}}》</span>×<span>{{$order_item->count}}</span></p>
                    @endforeach
                </td> 
            </tr>
            <tr class="text-c">
                <td width="150">收件人</td>
                <td width="300" class="left">{{$orders->names}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">送货地址</td>
                <td width="300" class="left">{{$orders->address}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">电话号码</td>
                <td width="300" class="left">{{$orders->tel}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">下单时间</td>
                <td width="300" class="left">{{$orders->created_at}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">交易状态</td>
                <td width="300" class="left">
                @if($orders->status==0)待支付@endif
                @if($orders->status==2)待发货@endif
                @if($orders->status==3)已发货@endif
                @if($orders->status==4)交易完成@endif   
                </td> 
            </tr>
        </tbody>
    </table>
</div>

@endsection
