@extends('admin.master')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 分类管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        <span class="l">
            <a href="javascript:;" onclick="categroy_add('添加类别','/admin/categroy_add','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加类别</a></span>
            <span class="r">共有数据：<strong>{{count($categries)}}</strong> 条</span> </div>
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">类别名称</th>
                <th width="40">类别编号</th>
                <th width="90">父类别</th>
                <th width="100">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categries as $categroy)
            <tr class="text-c">
                <td>{{$categroy->id}}</td>
                <td>{{$categroy->name}}</td>
                <td>{{$categroy->categroy_no}}</td>
                <td>
                    @if($categroy->parent!=null)
                        {{$categroy->parent->name}}
                    @endif
                </td>
                <td class="td-manage">
                <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-add.html','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>  
                <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

@endsection
@section('my-js')
<script type="text/javascript">
    function categroy_add(name,url){
    var index = layer.open({
        type: 2,
        title: name,
        content: url
    });
    layer.full(index);
}
</script>
@endsection