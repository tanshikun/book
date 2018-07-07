@extends('admin.master')

@section('content')
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
    <p class="f-20 text-success">欢迎使用书城 <span class="f-14">v1.0.0</span>后台！</p>
    
    </table>
    <table class="table table-border table-bordered table-bg mt-20">
        <thead>
            <tr>
                <th colspan="2" scope="col">服务器信息</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th width="30%">服务器计算机名</th>
                <td><span id="lbServerName">http://127.0.0.1/</span></td>
            </tr>
            <tr>
                <td>服务器IP地址</td>
                <td>192.168.1.1</td>
            </tr>
            <tr>
                <td>服务器域名</td>
                <td>www.book.com</td>
            </tr>
            <tr>
                <td>服务器端口 </td>
                <td>80</td>
            </tr>
            <tr>
                <td>服务器IIS版本 </td>
                <td>Microsoft-IIS/6.0</td>
            </tr>
            <tr>
                <td>本文件所在文件夹 </td>
                <td>D:\phpStudy\PHPTutorial\WWW\mylaravels\book</td>
            </tr>
            <tr>
                <td>服务器操作系统 </td>
                <td>Microsoft Windows NT 5.2.3790 Service Pack 2</td>
            </tr>
            <tr>
                <td>系统所在文件夹 </td>
                <td>C:\WINDOWS\system32</td>
            </tr>
            <tr>
                <td>服务器脚本超时时间 </td>
                <td><input type="hidden" name="systime" id="systime" onchang="startTime()" value=""></td>
            </tr>
            <tr>
                <td>服务器的语言种类 </td>
                <td>Chinese (People's Republic of China)</td>
            </tr>
            <tr>
                <td>.NET Framework 版本 </td>
                <td>2.050727.3655</td>
            </tr>
            <tr>
                <td>服务器当前时间 </td>
                <td id="serverTime"></td>
            </tr>
<script type="text/javascript">
    
    var timeDiff=new Date().valueOf()-<?php echo time()*1000;?>;
    function serverTime(){
            this.date = new Date();
            date.setTime(new Date().valueOf()-timeDiff);
            this.year   =date.getFullYear();
            this.month  =date.getMonth()+1;
            this.day    =date.getDate();
            this.hour   =date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
            this.minute =date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
            this.second =date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
            var s=year+'年'+month+'月'+day+'日 '+hour+':'+minute+':'+second;
            document.getElementById("serverTime").innerHTML=s;
    }
      window.onload=function(){
            serverTime(); 
            setInterval(function(){
            serverTime();
            }, 1000);
    }  
</script>     

            <tr>
                <td>服务器IE版本 </td>
                <td>6.0000</td>
            </tr>
            <tr>
                <td>服务器上次启动到现在已运行 </td>
                <td>7210分钟</td>
            </tr>
            <tr>
                <td>逻辑驱动器 </td>
                <td>C:\D:\</td>
            </tr>
            <tr>
                <td>CPU 总数 </td>
                <td>4</td>
            </tr>
            <tr>
                <td>CPU 类型 </td>
                <td>x86 Family 6 Model 42 Stepping 1, GenuineIntel</td>
            </tr>
            <tr>
                <td>虚拟内存 </td>
                <td>52480M</td>
            </tr>
            <tr>
                <td>当前程序占用内存 </td>
                <td>3.29M</td>
            </tr>
            <tr>
                <td>Asp.net所占内存 </td>
                <td>51.46M</td>
            </tr>
            <tr>
                <td>当前Session数量 </td>
                <td>8</td>
            </tr>
            <tr>
                <td>当前SessionID </td>
                <td>gznhpwmp34004345jz2q3l45</td>
            </tr>
            <tr>
                <td>当前系统用户名 </td>
                <td>NETWORK SERVICE</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 
<!--此乃百度统计代码，请自行删除-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
function startTime(){
    
}
</script>
<!--/此乃百度统计代码，请自行删除-->

