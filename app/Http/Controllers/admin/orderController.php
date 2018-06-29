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
}
