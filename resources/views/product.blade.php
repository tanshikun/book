@extends('master')

@section('title','书籍列表')

@section('content')
<div class="weui-cells__title"></div>
<div class="weui-cells">
    @foreach($products as $product)
    <div class="weui-cell weui-cell_select"   style="position:relative;" >
        <div class="weui-cell__bd bk_padding">
                <a class="weui_cell" href="/product/{{$product->id}}">
                    <div class="weui_cell_hd bk_left"><img class="bk_preview" src="{{$product->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary bk_right"  style="position:relative; width:60%; padding:5px" >
                        <div class="bk_float">
                            <p class="bk_title bk_font_color">{{$product->name}}</p><!-- 名字 -->
                            <p class="bk_price bk_font_color1">¥{{$product->price}}</p>
                        </div>
                        <p class="bk_summary bk_font_color bk_font_size">{{$product->summary}}</p><!-- 简介 -->
                    </div>
                    <!-- <div class="weui_cell_ft bk_font_color bk_font_size"></div> -->
                </a>
        </div>  
    </div>
    @endforeach
</div>

@endsection

@section('my-js')
<script type="text/javascript"></script>

@endsection
