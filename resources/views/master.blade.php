<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <title>@yield('title')</title>
    <script src="/js/jquery.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/weui.css"/>
    <script src="/js/ajax.js" type="text/javascript" charset="utf-8" async defer></script>
    <link rel="stylesheet" href="/css/tab_bar.css" />
</head>
<body style="bgcolor:#eeeeee;">

<div class="bk_title_bar">
        <img class="bk_back" src="/images/back.png" alt="" onclick="history.go(-1);" />
        <p class="bk_title_content"></p>
        <img class="bk_meun" src="/images/Category.png" alt="" id="menu"/>
    </div>
<section>    
    @yield('content')

<div class="page">

    <div class="bk_toptips"><span></span></div>

    <div class="weui-skin_android" id="androidActionsheet" style="display: none">
        <div class="weui-mask"></div>
        <div class="weui-actionsheet">
            <div class="weui-actionsheet__menu">
                <div class="weui-actionsheet__cell" style="text-align:center" id="user_register">用户注册</div>
                <div class="weui-actionsheet__cell" style="text-align:center" id="user_login">用户登录</div>
                <div class="weui-actionsheet__cell" style="text-align:center" id="categroy_list">商品列表</div>
                <div class="weui-actionsheet__cell" style="text-align:center" id="pdt_cart">购物车</div>
                <div class="weui-actionsheet__cell" style="text-align:center">个人中心</div>
            </div>
        </div>
    </div>
    <!--END actionSheet-->
</div>
<script type="text/javascript">

    $(function(){
        var $androidActionSheet = $('#androidActionsheet');
        var $androidMask = $androidActionSheet.find('.weui-mask');
        $("#menu").on('click', function(){
            $androidActionSheet.fadeIn(200);
            $androidMask.on('click',function () {
                $androidActionSheet.fadeOut(200);
            });
        });
    });

    $('.bk_title_content').html(document.title);


    $(function(){
         $("#user_register").on('click', function(){
            location.href="/register";
         });
         $("#user_login").on('click', function(){
            location.href="/login";
         });
         $("#categroy_list").on('click', function(){
            location.href="/categroy";
         });
         $("#pdt_cart").on('click', function(){
            location.href="/cart";
         });
    });


function onMenuItemClick(index) {
  var mask = $('#mask');
  var weuiActionsheet = $('#weui_actionsheet');
  hideActionSheet(weuiActionsheet, mask);
  if(index == 1) {

  } else if(index == 2) {

  } else if(index == 3){

  } else {
    $('.bk_toptips').show();
    $('.bk_toptips span').html("敬请期待!");
    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
  }
}
</script>
</section>
</body>
    @yield('my-js')
</html>