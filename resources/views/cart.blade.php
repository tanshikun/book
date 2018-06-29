@extends('master')

@section('title','购物车')
<link rel="stylesheet" href="/css/lunbotu.css" />
@section('content')
<section class="page1">
<div class="weui-cells__title">购物车列表<span style="float:right; font-size:14px;" id="quanxuan" onclick='selectAll()'>全选</span></div>
        <div class="weui-cells weui-cells_checkbox">
    @if($cart_items!=null&&$cart_items!='')
        @foreach($cart_items as $cart_item)
            <label class="weui-cell weui-check__label" for="{{$cart_item->product->id}}">
                <div class="weui-cell__hd">
                    <input type="checkbox" class="weui-check" name="cart_item" id="{{$cart_item->product->id}}"/>
                    <i class="weui-icon-unchecked" ></i>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <div style="position:relative; width:100%; padding:5px" >
                        <img src="{{$cart_item->product->preview}}" class="bk_preview" onclick="product_content();">
                        <div style="position:absolute; left:100px;right:0;top:0; width:50em;">
                        <p style="width:50em; font-size:16px">{{$cart_item->product->name}}</p>
                        <p class="bk_time" style="margin-top:15px;font-size:14px">数量：<span class="bk_summary">×{{$cart_item->count}}</span></p>
                        <p class="bk_time" style="font-size:14px">总计：<span class="bk_price">¥{{$cart_item->product->price*$cart_item->count}}</span></p>   
                        </div>
                    </div>
                </div>
            </label>
        @endforeach    
    @endif     
        <div class="weui-cells__title" style="text-align:center; color:green; line-height:40px; height:40px; font-size:16px" onclick="add_product()">
            点击添加更多>>
        </div>
    <div class="bk_btn1"><a href="javascript:;"  onclick="toDelete();" class="weui-btn weui-btn_default">删除</a>
        
    </div>
    <div class="bk_btn2">
        <a href="javascript:;"  onclick="toCharge();" class="weui-btn weui-btn_primary" >结算</a>
    </div>
</div>
</section>
@endsection

@section('my-js')
<script type="text/javascript">
    $('input:checkbox[name=cart_item]').click(function(event){//用属性选择器选择input对应的checkbox里面name为购物车cart_item的元素进行便利
    var checked = $(this).attr('checked');
    if(checked=='checked'){
        $(this).attr('checked',false);
        $(this).next().removeClass('weui-icon-checked');
        $(this).next().addClass('weui-icon-unchecked');
    }else{
        $(this).attr('checked','checked');
        $(this).next().removeClass('weui-icon-unchecked');
        $(this).next().addClass('weui-icon-checked');
    } });    
    
    
</script>
<script type="text/javascript">
    function toDelete(){
        var checked = $(this).attr('checked');
        var product_id_arr = [];
        $('input:checkbox[name=cart_item]').each(function(index,el){//用属性选择器选择input对应的checkbox里面name为购物车cart_item的元素进行便利
            
            if($(this).attr('checked')=='checked'){
             product_id_arr.push($(this).attr('id'));
            }
        });
        console.log(product_id_arr);

        if(product_id_arr.length==0){
            $('.bk_toptips').show();
            $('.bk_toptips span').html("请选择删除项!");
            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
        }

        $.ajax({
                type:"get",
                url:'/cart/deleteCart',
                dataType:'json',
                cache:false,
                data:{product_id:product_id_arr+''},
                success:function(data){
                    if(data==null){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("服务器端错误!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                        return;
                    }
                    if(data.status!=0){
                        
                    }
                    location.reload();//界面数据重新获取
                } 
            }); 
    }
function selectAll(){
            var checkeds = $('input:checkbox[name=cart_item]').attr('checked');
            if(checkeds=='checked'){
                $('input:checkbox[name=cart_item]').attr('checked',false);
                $('input:checkbox[name=cart_item]').next().removeClass('weui-icon-checked');
                $('input:checkbox[name=cart_item]').next().addClass('weui-icon-unchecked');
                $('#quanxuan').html('全选');
            }else{
                $('input:checkbox[name=cart_item]').attr('checked','checked');
                $('input:checkbox[name=cart_item]').next().removeClass('weui-icon-unchecked');
                $('input:checkbox[name=cart_item]').next().addClass('weui-icon-checked');
                $('#quanxuan').html('全不选');
            }
    }

    function add_product(){
        location.href="/categroy";
    }

    function toCharge(){
        var product_id_arr = [];
        $('input:checkbox[name=cart_item]').each(function(index,el){//用属性选择器选择input对应的checkbox里面name为购物车cart_item的元素进行便利
            if($(this).attr('checked')=='checked'){
             product_id_arr.push($(this).attr('id'));
            }
        });
        console.log(product_id_arr);
        if(product_id_arr.length==0){
            $('.bk_toptips').show();
            $('.bk_toptips span').html("请选择提交项!");
            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
            return;
        }
        //console.log(product_id_arr);
        location.href='/order_submit/'+product_id_arr;
    }
</script>
   
@endsection