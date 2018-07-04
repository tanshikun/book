@extends('master')

@section('title','登录')

@section('content')
    <div style="text-align:center;height:150px;" >
    <img src="images/userLoading.png" style="width:100px;height:100px;padding-top:25px">
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="tel" class="weui-input" id="user_name" name="user_name" placeholder="请输入用户名"/></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="password" id="password" name="password" class="weui-input" placeholder="请输入密码"/></div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="text" class="weui-input" id="safe_code" name="safe_code"></div>
            <img src="/safe/code" alt="" onclick="this.src='/safe/code?'+Math.random()">
            <div class="weui-cell__ft">![](service/validate_code/create)</div>
        </div>
    </div>
    <div class="weui-cells__tips"></div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" id="onLoginClick" onclick="onLoginClick()">登录</a>
    </div>
    <script type="text/javascript">
        function onLoginClick(){
            var user_name = document.getElementById('user_name');
            var password = document.getElementById('password');
            var safe_code = document.getElementById('safe_code');
            ajax('post','/ajax_on_login','user_name='+user_name.value+'&password='+password.value+'&safe_code='+safe_code.value+'&_token={{csrf_token()}}',
                function(data){
                    console.log(data);
                    if(data==null){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("服务器端错误!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    return;
                    }
                if(data==11){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("验证码输入不正确!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }
                if(data==12){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("用户名不能为空!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }
                if(data==13){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("密码不正确!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }
                if(data==14){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("用户名不存在!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }
                if(data==15){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("登录成功!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    @if(isset($return_url))
                    location.href="{{$return_url}}";
                    @else
                    location.href="/categroy";
                    @endif
                }
            }); 
        }
    </script>
    <div style="text-align:center">
         <a href="/register" class="important-tips">没有账户，立即注册！</a>
    </div>

    <div class="page__bd page__bd_spacing">
        
        <br>
        <br>
        <div class="weui-footer">
            <p class="weui-footer__links">
                <a href="javascript:void(0);" class="weui-footer__link">关于我们</a>
                <a href="javascript:void(0);" class="weui-footer__link">联系我们</a>
            </p>
            <p class="weui-footer__text">Copyright &copy; 2008-2016 weui.io</p>
        </div> 
    </div>
@endsection



