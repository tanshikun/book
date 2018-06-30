@extends('admin.master')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
    <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 

    </span> 
    <span class="r">共有订单：<strong></strong> 件</span> </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="10">订单列表</th>
            </tr>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="40">ID</th>
                <th width="150">会员号</th>
                <th width="90">订单号</th>
                <th width="150">收件人</th>
                <th width="150">送货地址</th>
                <th width="150">电话号码</th>
                <th width="130">下单时间</th>
                <th width="130">交易状态</th>
                <th width="100">操作</th>
            </tr>
        </thead>

        <tbody>
@foreach($orders as $order)
            <tr class="text-c">
            
                <td><input type="checkbox" value="1" name=""></td>
                <td>{{$order->id}}</td>
                <td>
                    @if($order->member->email!=null&&$order->member->email)
                    {{$order->member->email}}
                    @else{{$order->member->phone}}
                    @endif
                </td>
                <td>{{$order->order_no}}</td>
                <td>{{$order->names}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->created_at}}</td>
                @if($order->status==0)
                <td class="td-status"><span class="label label-success radius" style="background-color:red">待支付</span></td>
                <td class="td-manage">
                <a title="产品详情" href="javascript:;" onclick="order_content('订单详情','/admin/order_content/{{$order->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a> 
                @endif
                @if($order->status==2)
                <td class="td-status"><span class="label label-success radius"  style="background-color:orange">待发货</span></td>
                <td class="td-manage">
                <a title="产品详情" href="javascript:;" onclick="order_content('订单详情','/admin/order_content/{{$order->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a> 
                <a title="点击发货" href="javascript:;" onclick="send_goods('{{$order->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe634;</i></a>
                </td>
                @endif
                @if($order->status==3)
                <td class="td-status"><span class="label label-success radius">已发货</span></td>
                <td class="td-manage">
                <a title="产品详情" href="javascript:;" onclick="order_content('订单详情','/admin/order_content/{{$order->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a> 
                <a title="查看物流" href="javascript:;" onclick="" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe669;</i></a>
                </td>
                @endif
                @if($order->status==4)
                <td class="td-status"><span class="label label-success radius">交易完成</span></td>
                <td class="td-manage">
                <a title="产品详情" href="javascript:;" onclick="order_content('订单详情','/admin/order_content/{{$order->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a> 
                <a title="删除" href="javascript:;" onclick="order_del()" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
                @endif
            </tr>
   @endforeach
            
        </tbody>
    </table>
</div>
@endsection
@section('my-js')
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

    function order_content(name,url,id){
        var index = layer.open({ 
        type: 2,
        title: name,
        content: url
    });
    layer.full(index);
    }
</script>
<script type="text/javascript">
    function product_del(name,id){
        layer.confirm('确认要删除【'+name+'】吗？',function(index){
             ajax('post',
                    '/admin/product/del',
                    'id='+id+'&_token={{csrf_token()}}',
                    function(data){

                        if(data==null){
                            alert('服务器错误');
                            return;
                        }
                        if(data!=9){
                            alert('删除失败');
                            return;
                        }
                        if(data==9){
                            location.replace(location.href);
                        } 
                    }
                    );
        });
    } 
    function send_goods(id){
        layer.confirm('确认发货？',function(index){
            $.ajax({
            url: '/admin/send_goods/'+id,
            type: 'POST',
            dataType: 'json',
            data: {id:id,
                   _token:'{{csrf_token()}}'},
            success:function(data){
                if(data=='ok'){
                    alert('发货成功！');
                    location.replace(location.href);
                } 
            }
        });
        });
    }
        

</script>


@endsection