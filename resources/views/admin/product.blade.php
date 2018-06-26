@extends('admin.master')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="product_add('添加产品','/admin/product_add')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong>{{count($products)}}</strong> 条</span> </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="9">产品列表</th>
            </tr>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="40">ID</th>
                <th width="150">产品名称</th>
                <th width="90">产品简介</th>
                <th width="150">产品价格</th>
                <th width="150">预览图</th>
                <th width="130">父类别</th>
                <th width="100">操作</th>
            </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
            <tr class="text-c">
                <td><input type="checkbox" value="1" name=""></td>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->summary}}</td>
                <td>{{$product->price}}</td>
                <td><img src="{{$product->preview}}" alt="" style="width:100px;height:100px"></td>
                <td>
                    @if($product->parent!=null)
                        {{$product->parent->name}}
                    @endif
                </td>
                <td class="td-manage">
                <a title="产品详情" href="javascript:;" onclick="product_content('产品详情','/admin/product_content/{{$product->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a> 
                <a title="编辑" href="javascript:;" onclick="product_edit('编辑','product_edit')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                <a title="删除" href="javascript:;" onclick="product_del('{{$product->name}}',{{$product->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
            @endforeach
            
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


</script>


@endsection