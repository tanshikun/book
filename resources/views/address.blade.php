@extends('master')

@section('title','填写收货信息')
<link rel="stylesheet" href="/css/lunbotu.css" />
@section('content')
<section class="page1">
<div class="weui-cells__title">填写收货信息</div>
        <div class="weui-cells weui-cells_checkbox">
  
    <div class="weui-cells__title"></div>
        <div class="weui-cell">
        <div class="weui-cell__bd">
            收件人：<span style="float:right;margin-right:10px;color:red; font-weight:bold"><input type="text" name="names" value="" id="names" style="height:25px;width:250px;"></span>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            电话号码：<span style="float:right;margin-right:10px;color:red; font-weight:bold"><input type="text" name="tel" value="" id="tel"  style="height:25px;width:250px;"></span>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            详细地址：<span style="float:right;margin-right:10px;color:red; font-weight:bold"><input type="text" name="address" value=""  id="address" style="height:25px;width:250px"></span>
        </div>
    </div>
 
    </div>
</div>  

    <div class="bk_btn3">
        <a href="javascript:;"  onclick="address_submit" class="weui-btn weui-btn_primary" >确定</a>
    </div>

</section>
@endsection

@section('my-js')

<script type="text/javascript">

function address_submit(){
    var value =$('#weui-select').val();
    var name=$('#names').val();
    var tel=$('#tel').val();
    var address=$('#address').val();
    $.ajax({
        url: '/order_address',
        type: 'POST',
        dataType: 'json',
        data: {value: value,
                name:name,
                tel:tel,
                address:address,
                _token:"{{csrf_token()}}"},
    });
    
}

</script>
   
@endsection
