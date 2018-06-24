@extends('master')

@section('title',$product->name)
<link rel="stylesheet" href="/css/lunbotu.css" />
@section('content')
<section class="page1">
<div class="bk_content">
    <div class="slideBox">
    <ul>
    @foreach($product_images as $product_image)
        <li><img src="{{$product_image->image_path}}" alt="" width="250" height="300"/></li>
    @endforeach
    </ul>
    <div class="spanBox">
    @foreach($product_images as $product_image)
        <span class="active"></span>
    @endforeach
    </div>
    
    </div>

    <div class="weui_cells_title">
            <span class="bk_title bk_font_color">{{$product->name}}</span>
            <span class="bk_price bk_font_color1">¥{{$product->price}}</span>
    </div>
    <div class="weui_cells">
        <div class="weui_cell">
               <p class="bk_summary bk_font_color bk_font_size" onclick
               ="showButton()">{{$product->summary}}</p>
        </div>
    </div>
    <div class="weui_cells_title">详细介绍</div>
       <div class="weui_cells">
           <div class="weui_cell">
                @if($product_content!=null){
                    {!! $product_content->content !!}
                }else{

                }@endif
                  
                  {{--通过{!!hello!!} 来转义文章详情   文章详情含有html标签样式  如果不转义  会直接将标签显示--}}
           </div>
    </div> 
</div>

<div>
    <div class="bk_btn1">
        <a href="javascript:;"  onclick="addCart();" class="weui-btn weui-btn_primary" >加入购物车</a>
    </div>
    <div class="bk_btn2">
        <a href="javascript:;"  onclick="toCart();" class="weui-btn weui-btn_default">查看购物车（<span class="" id="cart_num">{{$count}}</span>）</a>
    </div>
</div>

</section>

@endsection

@section('my-js')
<script type="text/javascript">
 $(document).ready(function(){//轮播图的js代码
     var slideBox = $(".slideBox");
     var ul = slideBox.find("ul");
     var oneWidth = slideBox.find("ul li").eq(0).width();
     var number = slideBox.find(".spanBox span");            //注意分号 和逗号的用法
     var timer = null;
     var sw = 0;                    
     //每个span绑定click事件，完成切换颜色和动画，以及读取参数值
     number.on("click",function (){
     $(this).addClass("active").siblings("span").removeClass("active");
     sw=$(this).index();
     ul.animate({
            "right":oneWidth*sw,    //ul标签的动画为向左移动；
               });
     });
    //定时器的使用，自动开始
    timer = setInterval(function (){
        sw++;
        if(sw==number.length){sw=0};
        number.eq(sw).trigger("click");
        },2000);
    //hover事件完成悬停和，左右图标的动画效果
    slideBox.hover(function(){
        $(".next,.prev").animate({
            "opacity":1,
            },200);
        clearInterval(timer);
        },function(){
            $(".next,.prev").animate({
                "opacity":0.5,
                },500);
        timer = setInterval(function (){
        sw++;
        if(sw==number.length){sw=0};
        number.eq(sw).trigger("click");
        },2000);
            });   
});

function addCart(){
    var id = "{{$product->id}}";
        $.ajax({
                type:"get",
                url:'/cart/add/'+id,
                dataType:'json',
                cache:false,
                success:function(data){
                    if(data==null){
                        $('.bk_toptips').show();
                        $('.bk_toptips span').html("服务器端错误!");
                        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    }
                    if(data.status!=0){
                        
                    }
                  var num = $('#cart_num').html();//声明一个变量获取结算括号里的值
                  if(num==''){
                    num = 0;
                  }
                  $('#cart_num').html(Number(num)+1);
                }
                
            });
}

function toCart(){
    location.href="/cart";
}
</script>

@endsection
