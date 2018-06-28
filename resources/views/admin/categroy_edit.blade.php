@extends('admin.master')

@section('content')
<div class="form form-horizontal" id="form-categroy-add">
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类别名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="{{$categroy->name}}"id="name1" name="name1" style="width:400px">
 
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类别编号：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="number" class="input-text"   value="{{$categroy->categroy_no}}" placeholder="" id="categroy_no"  name="categroy_no" onclick="">
            
        </div> 

    </div> 
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">父类别：</label>
        <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
            <select class="select"  size="1" name="parent_id" id="parent_id">
                <option value="0">无</option>
                @foreach($categries as $temp)    
                 @if($categroy->parent_id==$temp->id)   
                 <option selected value="{{$temp->id}}">{{$temp->name}}</option> 
                @else
                 <option value="{{$temp->id}}">{{$temp->name}}</option> 
                 @endif
                @endforeach
            </select>
            </span> </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <script>
        
    </script>

        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3" style="margin-top:20px">
            <input class="btn btn-primary radius" onclick="tijiao()" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        </div>
    </div>
    </div>
@endsection
@section('my-js')
<script type="text/javascript">
function tijiao(){
    var name1 = document.getElementById('name1').value;
    var categroy_no = document.getElementById('categroy_no').value;
    var sel = document.getElementById('parent_id');
    var index = sel.selectedIndex;
    var parent_id = sel.options[index].value;
    var id = "{{$categroy->id}}";
    ajax('post','/admin/categroy/edit','id='+id+'&name='+name1+'&categroy_no='+categroy_no+'&parent_id='+parent_id+'&_token={{csrf_token()}}',function(data){
           if(data==8){
               alert('修改成功！');
               parent.location.reload();//成功之后刷新当前页面的父页面
           }
   });
}
</script> 
@endsection

