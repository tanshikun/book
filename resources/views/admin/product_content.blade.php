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
                <th width="450">产品详情</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-c">
                <td width="150">产品名称</td>
                <td width="300" class="left">{{$products->product->name}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">产品简介</td>
                <td width="300" class="left">{{$products->product->summary}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">产品价格</td>
                <td width="300" class="left">{{$products->product->price}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">产品类别</td>
                <td width="300" class="left">{{$products->product->categroy->name}}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">预览图</td>
                <td width="300" class="left"><img src="{{$products->product->preview}}" alt="" style="width:100px;height:100px" /></td> 
            </tr>
            <tr class="text-c">
                <td width="150">详细内容</td>
                <td width="300" class="left">{!!$products->content!!}</td> 
            </tr>
            <tr class="text-c">
                <td width="150">产品图片</td>
                <td width="300" class="left">
                @foreach($images as $image)
                    <img src="{{$image->image_path}}" alt="" style="width:100px;height:100px" />
                @endforeach
                </td> 
            </tr>
        </tbody>
    </table>
</div>

@endsection
