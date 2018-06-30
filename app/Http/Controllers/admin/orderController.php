<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Entity\categroy;
use App\Entity\product;
use App\Entity\order;
use App\Entity\order_item;
use App\Entity\member;
use App\Entity\product_content;
use App\Entity\product_images;
use App\Models\Result;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function toCategroy(){
        $categries = categroy::all();
        foreach ($categries as $categroy) {
            if($categroy->parent_id!=''&&$categroy->parent_id!=null){
                $categroy->parent = categroy::where('id',$categroy->parent_id)->first();
            }
        }
        return view('admin/categroy')->with('categries',$categries);
   }
    public function toOrderList(){
            $orders=order::all();
            foreach ($orders as $order) {
                $order->member=member::where('id',$order->member_id)->first();
            }
            //return $orders;
            return view('admin/orderList')->with('orders',$orders);
    }
    public function order_content($id){
        $orders=order::where('id',$id)->first();//获取订单表里面对应订单id的数据
        $order_items=order_item::where('order_id',$id)->get();//获取订单列表中的数据
        foreach ($order_items as $order_item) {//便利购买商品的数据
            $order_item->product=product::where('id',$order_item->product_id)->first();
        }
        $members=member::where('id',$orders->member_id)->first();
        return view('admin/order_content')->with('orders',$orders)
                                          ->with('order_items',$order_items)
                                          ->with('members',$members);
    }
    public function send_goods($id){
        $orders=order::where('id',$id)->first();
        $orders->status=3;
        $orders->save();
        return response()->json('ok',200);
    }
    
}
