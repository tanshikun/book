<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Entity\categroy;
use App\Entity\product;
use App\Entity\product_content;
use App\Entity\product_images;
use Illuminate\Http\Request;

class orderController extends Controller
{
   public function toOrderPay(Request $request){
        return view('order_pay');
   }
}
