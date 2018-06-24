<?php
namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Entity\categroy;
use App\Entity\product;
use App\Entity\cart_item;
use App\Entity\member;
use App\Entity\product_content;
use App\Entity\product_images;
use Illuminate\Http\Request;


class bookController extends Controller
{
    public function toCategroy(){
        $categroys = categroy::whereNull('parent_id')->get();//通过parent_id为空来找出一级类别所对应的所有数据
        return view('categroy')->with('categroys',$categroys);//将取得的数据中   categroy字段所对应的值  返回到视图窗口categroy中去
    }

    public function getCategroyByParentId($parent_id){
         $categroys = categroy::where('parent_id',$parent_id)->get();//通过parent_id为空来找出一级类别所对应的所有数据
        return response()->json($categroys,200);//将取得的数据中   categroy字段所对应的值  返回到视图窗口categroy中去
    }

    public function toProduct($categroy_id){
        $products = product::where('categroy_id',$categroy_id)->get();
        return view('product')->with('products',$products);
    }

    public function toProductContent(Request $request,$product_id){
        $product = product::where('id',$product_id)->first();
        $product_content = product_content::where('product_id',$product_id)->first();
        $product_images = product_images::where('product_id',$product_id)->get();
        
        $count = 0;

        $member = $request->session()->get('member','');
        if($member!=''){
            $cart_items = cart_item::where('member_id',$member->id)->get();
            foreach ($cart_items as $cart_item) {
                if($cart_item->product_id == $product_id){
                    $count = $cart_item->count;
                    break;
                }
            }
        }else{
            $cart = $request->cookie('cart'); 
            $cart_arr = $cart!=null ? explode(',', $cart) : array();
            foreach($cart_arr as $value){
                $index = strpos($value,':');
                if(substr($value,0, $index)==$product_id){
                    $count = (int)substr($value,$index+1);
                    break;
                }
            }
        }


        return view('product_content',['product' => $product,
                                       'product_content'=>$product_content,
                                       'product_images'=>$product_images,
                                       'count'=>$count]);                               
    }

    
}