@extends('admin.master')
@section('content')
<link href="lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<div class="page-container">
    <div  class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" id="name" name="name" value="{{$product->name}}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>一级类别：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select name="categroy" id="categroy" class="select" onchange="changValue()">
               @foreach($categries as $categroy)
                    @if($categroy->id==$categroy_one->id)
                    <option value="{{$categroy->id}}" selected>{{$categroy->name}}</option>
                    @else
                    <option value="{{$categroy->id}}" >{{$categroy->name}}</option>
                    @endif
                @endforeach    
                </select>
                </span> </div>
        </div>
        

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>二级类别：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select name="categroy_next" id="categroy_next" class="select_next select">
                </select>
                </span> </div>
        </div>
        
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">简介：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" id="summary" name="summary" value="{{$product->summary}}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="price" id="price" class="input-text" style="width:90%" value="{{$product->price}}">
                元</div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细内容</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" id="content" style="width:100%;height:400px" value="{!!$product_content->content!!}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">预览图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-thum-container">
                    <div id="fileList" class="uploader-list"></div>
                    <input type="file" name="file" id="file_upload"/>
                </div>
            </div>
        </div>
       
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="submit()" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>  提交</button>
                <button onClick="" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('my-js')

<script type="text/javascript">
     window.onload=(changValue());
    //$('.weui-select').change(function(e){//监听选择发生变化时  所对应的parent_id的变化
        //changValue(e.currentTarget.value);
        //});
    function changValue(){
        var id= $('#categroy').val();//document.getElementById('categroy').value;
        console.log(id);
        $.ajax({
                type:"get",
                url:'/admin/categroy/product_add/'+id,
                dataType:'json',
                success:function(data){
                    console.log(data);
                    $('.select_next').html('');
                    data.forEach( function(e){
                     $('#categroy_next').append('<option value="'+e.id+'">'+e.name+'</option>');
                    });
                },
                error:function(data,status,sts){
                    console.log(data);
                } 
            });
    }


    function submit(){
        var content =$('#content').val();
        var name = $('#name').val();
        var parent_id = $('#categroy').val();
        var id=$('#categroy_next').val();
        var summary=$('#summary').val();
        var price=$('#price').val();
        var product_id="{{$product->id}}";
        var formData = new FormData();
            formData.append("image", $("#file_upload")[0].files[0]);
            formData.append("name",name);
            formData.append("parent_id",parent_id);
            formData.append("id",id);
            formData.append("summary",summary);
            formData.append("price",price);
            formData.append("content",content);
            formData.append("product_id",product_id);
            formData.append("_token",'{{csrf_token()}}');
            $.ajax({
                url: '/admin/product_edit',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (msg) {
                    alert(msg);
                    parent.location.reload();
                },
                error:function (data,status,sts) {
                    console.log(data);
                }
            });
    }

    
</script>
@endsection