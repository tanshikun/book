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

            <tr class="text-c">
            @foreach($orders as $order)
                <td><input type="checkbox" value="1" name=""></td>
                <td>{{$order->id}}</td>
                <td>{{$order->member->email}}</td>
                <td>{{$order->order_no}}</td>
                <td>{{$order->names}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->status}}</td>
                <td class="td-manage">
                <a title="产品详情" href="javascript:;" onclick="product_content('产品详情','')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a> 
                <a title="删除" href="javascript:;" onclick="product_del()" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
            @endforeach
            </tr>

            
        </tbody>
    </table>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
    function product_content(name,url,id){
        var index = layer.open({ 
        type: 2,
        title: name,
        content: url
    });
    layer.full(index);
    }
    function product_add(name,url){
        var index = layer.open({ 
        type: 2,
        title: name,
        content: url
    });
    layer.full(index);
    }

    function product_edit(name,url,id){
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
</script>


@endsection