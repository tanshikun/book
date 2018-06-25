@extends('master')
@section('title','注册')

@section('content')
<div class="weui-tab">
    <div class="weui-navbar">
        <div class="weui-navbar__item weui-bar__item_on" onclick="show('tel')" id="te">
                    手机注册
                    <div class="weui-cell__ft">
                        <input type="radio" class="weui-check" name="type" value="phone"  />
                    </div>
            </div>
            <div class="weui-navbar__item" onclick="show('email')" id="em">
                    邮箱注册
                    <div class="weui-cell__fd">
                        <input type="radio" class="weui-check" name="type" value="email" /> 
                    </div>
            </div> 
    </div>
    <div class="weui-tab__panel">
        <div><div class="weui-cells weui-cells_form">
    <div id="tel" style="display:block">
      <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">手机号码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="tel" name="phone" class="weui-input" id="phone"></div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label">验&nbsp;&nbsp;证&nbsp;&nbsp;码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="text" name="phone_vcode" class="weui-input" id="phone_vcode"></div>
            <div class="weui-cell__ft" id="dj_fs" onclick="gettel_tel()"><a class="weui-vcode-btn bk_phone_code_send" id="dj" name='send'  onclick="gettel()">发送验证码</a></div>
        </div> 
    </div>      
        <div id="email" style="display:none">
           <div class="weui-cell email">
            <div class="weui-cell__hd"><label class="weui-label">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="email" name="email" class="weui-input" id='emails'></div>
        </div> 
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label">验&nbsp;&nbsp;证&nbsp;&nbsp;码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="text" name="email_vcode" class="weui-input" id="email_vcode"></div>
            <div class="weui-cell__ft" id="dj_fs" onclick="gettel_email()"><a class="weui-vcode-btn bk_phone_code_send" id="dl" name='send'  onclick="gettel_1()">发送验证码</a></div>
        </div> 
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="password" name="password" id="password" class="weui-input" placeholder="不少于6位"> </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">重复密码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="password" name="repassword" id="repassword" class="weui-input"> </div>
        </div>
    </div>
    <label for="weuiAgree" class="weui-agree">
    <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox" name="weuiAgree" checked="checked"onclick="return false" >
    <span class="weui-agree__text">
        阅读并同意<a href="javascript:void(0);">《相关条款》</a>
    </span>
</label>
    <div class="weui-cells__tips"></div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" id="member_register" name="member_register" onclick="member_register()">注册</a>
    </div>
    <div style="text-align:center">
    <a href="/login" class="important-tips">已有账户，立即登录！</a>
    </div>
<script type="text/javascript">
//相关条款勾选
            
        let sendmode='tel';//设置手机注册页面的mode为tel,邮箱注册页面的mode为email,以便分开进行接值
       function member_register(){
            //判断两次密码输入是否一致
            var password = document.getElementById('password');
            var repassword = document.getElementById('repassword');
            if(password.value != repassword.value){
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html("两次输入密码不一致");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            
                //如果mode为tel，那么ajax接值为手机注册页面
                    if (sendmode=='tel') {
                        var tels=document.getElementById('phone');
                        var pwd=document.getElementById('password');
                        var code=document.getElementById('phone_vcode');
                       ajax('post','/logup','tel='+tels.value+'&password='+pwd.value+'&mode='+sendmode+'&code='+code.value+'&_token={{csrf_token()}}',function(data){
                            //console.log(data);
                            if(data == 101){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("请输入注册信息!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if(data == 102){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("请点击发送验证码!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if(data == 4){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("密码不能少于6位!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if(data == 3){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("该手机用户已注册!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if(data == 2){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("验证码输入不正确!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if (data == 5) {
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("恭喜您，注册成功!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                                location.href="/login";
                            }
                            });
                    }else{//否则为邮箱注册页面
                        var emails=document.getElementById('emails');
                        var pwd=document.getElementById('password');
                        var code=document.getElementById('email_vcode');
                        ajax('post','/logup','emails='+emails.value+'&mode='+sendmode+'&password='+pwd.value+'&code='+code.value+'&_token={{csrf_token()}}',function(data){
                            console.log(data);
                            if(data == 101){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("请输入注册信息!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if(data == 102){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("请点击发送验证码!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if(data == 7){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("密码不能少于6位!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if(data == 9){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("该邮箱已注册过!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                                        }
                            if(data == 6){
                               $('.bk_toptips').show();
                                $('.bk_toptips span').html("验证码输入不正确!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            }
                            if (data == 8) {
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html("恭喜您，注册成功!");
                                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                                location.href="/login";
                            }
                            });                      
                    }     
        }
</script>
    <div id="dialog1" style="display: none;">
    <div class="weui-dialog">
        <div class="weui-dialog__hd"><strong class="weui-dialog__title" id='password_repasswords'>弹窗标题</strong></div>
        <div class="weui-dialog__bd" id='password_repassword'>弹窗内容，告知当前状态、信息和解决方法，描述文字尽量控制在三行内</div>
    </div>
</div>
    <div id="toast" style="display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
            <p class="weui-toast__content" id="code-send-success">已完成</p>
        </div>
    </div>

    </div>
        <div style="display:none">Page 2</div>
        <div style="display:none">Page 3</div>
    </div>
    
<script type="text/javascript">
 
    function show(id){//隐藏或者显示手机注册和邮箱注册
        let tel=document.getElementById('te');
        let emi=document.getElementById('em');
        if (id=='tel') {
            document.getElementById('tel').style.display='block';
            document.getElementById('email').style.display='none';
            //document.getElementById('safe_code').style.display='none';
            tel.className='weui-navbar__item weui-bar__item_on';
            emi.className='weui-navbar__item';
            sendmode='tel';
        }else{
            document.getElementById('email').style.display='block';
            document.getElementById('tel').style.display='none';
            //document.getElementById('safe_code').style.display='block';
            emi.className='weui-navbar__item weui-bar__item_on';
            tel.className='weui-navbar__item';
            sendmode='email';
        }
    }
    var wait_time=60;//设置点击发送验证码倒计时
    var wait_time_email=300;
    function gettel(){//点击手机注册-发送验证码，返回手机号和token值
        var phone = document.getElementById('phone');
        ajax('post','/ajax_tel','phone='+phone.value+'&_token='+"{{csrf_token()}}",function(data){
            if (data==1) {
                $('.bk_toptips').show();
                    $('.bk_toptips span').html("手机号码格式不符!");
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
             }              
            });       
    }
    function gettel_1(){//点击邮箱注册-发送验证码，返回邮箱号和token值
        var emails = document.getElementById('emails');
        ajax('post','/ajax_email','emails='+emails.value+'&_token='+"{{csrf_token()}}",function(data){
            console.log(data);             
            });       
    }
    function gettel_tel(){
            if(wait_time!=60){
                document.getElementById('toast').style.display='block';
                document.getElementById('code-send-success').innerHTML='请等待'+wait_time+'秒';
                setTimeout(function() {
                document.getElementById('toast').style.display='none';
            }, 1000);
                return;
            }
            //再次点击  弹窗已发送
            document.getElementById('toast').style.display="block";
            document.getElementById('code-send-success').innerHTML="已发送";
            setTimeout(function(){
                document.getElementById('toast').style.display="none";
            },1000)
            clock();
        }
    function gettel_email(){
            if(wait_time_email!=300){
                document.getElementById('toast').style.display='block';
                document.getElementById('code-send-success').innerHTML='请等待'+wait_time_email+'秒';
                setTimeout(function() {
                document.getElementById('toast').style.display='none';
            }, 1000);
                return;
            }
            //再次点击  弹窗已发送
            document.getElementById('toast').style.display="block";
            document.getElementById('code-send-success').innerHTML="已发送";
            setTimeout(function(){
                document.getElementById('toast').style.display="none";
            },1000)
            clocks();
        }
    function clock(){
           var clock_time = setInterval(function(){//通过setInterval这个函数一直执行其中的代码
                    wait_time--;
                    document.getElementById('dj').innerHTML=wait_time+"秒后重新发送";
                    if(wait_time==0){
                        document.getElementById('dj').innerHTML="重新发送";
                        wait_time=60;
                        clock_time = window.clearInterval(clock_time);
                    }
           },1000);
       }
       function clocks(){
           var clock_time = setInterval(function(){//通过setInterval这个函数一直执行其中的代码
                    wait_time_email--;
                    document.getElementById('dl').innerHTML= wait_time_email+"秒后重新发送";
                    if(wait_time_email==0){
                        document.getElementById('dl').innerHTML="重新发送";
                        wait_time_email=300;
                        clock_time = window.clearInterval(clock_time);
                    }
           },1000);
       }
</script>

    
</div>
  
@endsection
