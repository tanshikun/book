@extends('admin.master')

@section('content')

<link href="static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />

<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class=""></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <div class="form form-horizontal">
    {{csrf_field()}}
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="usernamess" name="usernamess" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input  type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;" onclick="toLogin()">
          <input  type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;" onclick="outLogin()">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="footer">Copyright 书城</div>
@endsection
@section('my-js')
<script>
    function toLogin(){
        var usernamess = document.getElementById('usernamess');
        var password = document.getElementById('password');
       $.ajax({
            url: '/admin/toLogin',
            type: 'post',
            dataType: 'json',
            data: {name:usernamess.value,
                    password:password.value,
                    _token:"{{csrf_token()}}"
                    },
            success:function(data){
                if(data==1){
                    alert('用户名不能为空');
                    return;
                }
                if(data==2){
                    alert('密码不能为空');
                    return;
                }
                if(data==3){
                    alert('用户名不存在');
                    return;
                }
                if(data==4){
                    alert('密码错误');
                    return;
                }
                if(data==5){
                    alert('登录成功');
                    location.href="index";
                }
            }
        }); 
    }  

</script>
@endsection