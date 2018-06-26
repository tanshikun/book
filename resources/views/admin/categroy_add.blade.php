@extends('admin.master')

@section('content')
<div class="form form-horizontal" id="form-categroy-add">
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类别名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="" placeholder="" id="name1" name="name1" onclick="" style="width:400px"><span id="type_name" style="display:block;color:red;font-size:12px;">类别名称不能为空</span>
<script type="text/javascript">
    var sss = document.getElementById('name1');
    var type_name = document.getElementById('type_name');
   if('oninput' in sss){
        sss.addEventListener("input",show,false);
   }else{
        sss.onpropertychange=show;
   }
   function show(){
        document.getElementById('type_name').innerHTML="";
   }

</script> 
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类别编号：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="number" class="input-text"   value="0" placeholder="" id="categroy_no"  name="categroy_no" onclick="">
            <p id="type_no" style="display:block;color:red;font-size:12px;">类别编号不能为空</p>
        </div> 
<script type="text/javascript">
     var categroy_no = document.getElementById('categroy_no');
        var type_no = document.getElementById('type_no');
       if('oninput' in categroy_no){
            categroy_no.addEventListener("input",show,false);
       }else{
            categroy_no.onpropertychange=show;
       }
       function show(){
            document.getElementById('type_no').innerHTML="";
       }
</script>
    </div> 
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">父类别：</label>
        <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
            <select class="select"  size="1" name="parent_id" id="parent_id">
                <option value="0">无</option>
                @foreach($categries as $categroy)       
                 <option value="{{$categroy->id}}">{{$categroy->name}}</option>          
                @endforeach
            </select>
            </span> </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">预览图：</label>
        <div class="formControls col-xs-8 col-sm-9"> 
                <input type="file" name="file" id="file_upload" />

            </div>
    </div>
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

    ajax('post','/admin/categroy/add','name='+name1+'&categroy_no='+categroy_no+'&parent_id='+parent_id+'&_token={{csrf_token()}}',function(data){
            if(data==6){
                alert('请认真填写类别名称');
                return;
            }
            if(data==7){
                alert('请认真填写类别编号');
               return;
           }
           if(data==8){
               alert('添加成功！');
               parent.location.reload();//成功之后刷新当前页面的父页面
           }
   });}
</script> 
@endsection

