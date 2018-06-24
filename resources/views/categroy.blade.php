@extends('master')

@section('title','书籍类别')

@section('content')

<div class="weui-cells__title">选择书籍类别</div>
<div class="weui-cells">
    <div class="weui-cell weui-cell_select">
        <div class="weui-cell__bd">
            <select class="weui-select" name="select1" id="weui-select">
                @foreach($categroys as $categroy)
                <!--
                    通过调用foreach循环 来调用option 来控制一级选择器
                -->
                <option selected="" value="{{$categroy->id}}">{{$categroy->name}}</option>
                @endforeach 
            </select>
        </div>
    </div>
</div>
<!-- <div class="weui-cells">
    <div class="weui-cell weui-cell_select weui-cell_select-after">
       <div class="weui-cell__hd">
           <label for="" class="weui-label">国家/地区</label>
       </div>
       <div class="weui-cell__bd">
           <select class="weui-select" name="select2">
               <option value="{{$categroy->id}}">{{$categroy->name}}</option>

           </select>
       </div>
   </div>
</div> -->
<div class="weui-cells weui-cells_access" id="total">
   
</div> 
@endsection

@section('my-js')

<script type="text/javascript">
 
    window.onload=(getCategroy(1));

    $('.weui-select').change(function(e){//监听选择发生变化时  所对应的parent_id的变化
        getCategroy(e.currentTarget.value);
        });
    function getCategroy(id){
     
        $.ajax({
                type:"get",
                url:'/categroy/parent_id/'+id,
                dataType:'json',
                cache:false,
                success:function(data){
                    if(data==null){
                        $('.bk_toptips').show();
                    $('.bk_toptips span').html("服务器端错误!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                        return;
                    }
                    if(data.status!=0){
                        
                    }
                    $('.weui-cells_access').html('');
                    data.forEach( function(e){
                      var next = '/product/categroy_id/'+e.id;
                     document.getElementById('total').innerHTML+='<a class="weui-cell" href="'+next+'">'+
                     '<div class="weui_cell_bd weui_cell_primary">'+
                     '<p class="bk_font_color">'+e.name+'</p>'+
                     '</div>'+
                     '<div class="weui_fell_ft"></div>'+
                     '</a>';
                    });
                }
                
            });
    }

    

          

            
</script>
@endsection