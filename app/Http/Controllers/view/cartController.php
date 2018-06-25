<?php
namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Entity\categroy;
use App\Entity\product;
use App\Entity\cart_item;
use App\Entity\product_content;
use App\Entity\product_images;
use Illuminate\Http\Request;
use App\Entity\member;
use App\Entity\order;
use App\Entity\order_item;
use App\Models\Result;

class cartController extends Controller
{
    public function addCart(Request $request,$product_id){
        $result= new result;
        $result->status=0;
        $result->message='添加成功';

        //当前如果用户已登录
        $member = $request->session()->get('member','');
        if($member!=null&&$member!=''){
            $cart_items=cart_item::where('member_id',$member->id)->get();
            $exist=false;
            foreach($cart_items as $cart_item){
                if($cart_item->product_id == $product_id){
                    $cart_item->count++;
                    $cart_item->save();
                    $exist=true;
                    break;
                }     
            }
            if($exist==false){
                    $cart_item = new cart_item;
                    $cart_item->product_id=$product_id;
                    $cart_item->member_id=$member->id;
                    $cart_item->count=1;
                    $cart_item->save();
                }
            return response()->json(50,200);
        }


        $cart = $request->cookie('cart'); //通过request中的cookie方法来获取cart值 获取的值为字符串
        $cart_arr = $cart!=null ? explode(',', $cart) : array();//用，拆分获取的值  保存在cart_arr中
        //一般形式为：  1：1   2：1  3：2   冒号前面为产品id  后面为产品数据
        $count = 1;
        foreach($cart_arr as &$value){//一定要传引用  获取索引在字符串中的位置
            $index = strpos($value,':');//用strpos获取冒号：在获取的字符串中的位置
            if(substr($value,0, $index)==$product_id){//使用substr来截取这个字符串中从0开始到冒号所在字符串位置结束中的值  判断是否与产品id相等 如果相等  继续执行代码 就获取：右边的值
                $count = ((int)substr($value,$index+1))+1;//从冒号所在的位置开始截取 到这个字符串结束 以此获取产品的个数并+1.获取到产品的id和产品的个数  
                $value = $product_id .':'. $count;
            
                break;//跳出循环
            }
        }
        //判断count是否为1 如果为1  代表没有在购物车列表中找到这条产品的信息 即为我们新添加的产品
        if($count == 1){//通过array_push来讲这条新添加商品添加到我们的数组中
            array_push($cart_arr, $product_id .':'. $count);
        }
        //讲返回值添加到cookie中
        $cart_arrs = implode(',', $cart_arr);
        return response()->json($cart_arrs,200)
                         ->withCookie('cart',$cart_arrs);

    }
    
    

public function toCart(Request $request){
        $cart_items = array();
        $cart = $request->cookie('cart'); 
        //return $cart;
        $cart_arr = ($cart!=null ? explode(',', $cart) : array());
        //return $cart_arr;
        //判断用户是否登录：获取session里面的member
        $member = $request->session()->get('member','');
        //return $member->id;
        if($member!=''){//如果用户已登录 我们需要同步购物车
            //$member_id = $member->id;
            $cart_items = $this->tongbuCart($member->id,$cart_arr);// member->id为19  购物车为 18:3  21:3
            //同步购物车方法，同步信息保存在cart_items中
            return view('cart',['cart_items'=>$cart_items]);
        }

        foreach($cart_arr as $key => $value){
            $index = strpos($value,':');
            $cart_item = new cart_item;//创建实体类
            $cart_item->id=$key;
            $cart_item->product_id=substr($value,0,$index);
            $cart_item->count=(int)substr($value,$index+1);
            $cart_item->product=product::find($cart_item->product_id);
            if($cart_item->product != null){
                array_push($cart_items,$cart_item);
            }
        }
      //return view('cart')->with('cart_item',$cart_items);
       return view('cart',['cart_items' => $cart_items])->withCookie('cart',null);                        
     }

private function tongbuCart($member_id,$cart_arr){//将这个方法定义为私有的。member->id为19  购物车为 18:3  21:3
        $cart_items = cart_item::where('member_id',$member_id)->get();//查找cart_item表中所有member_id和19相等的数据
        //return $cart_items;
        $cart_item_arr = array();
        foreach ($cart_arr as $value) {
            $index = strpos($value,':');
            $product_id = substr($value,0,$index);
            $count = (int)substr($value,$index+1);
            //判断离线购物车中的商品id是否在数据库中存在
            $exist = false;
            if ($cart_items!=null||$cart_items!='') {
               foreach($cart_items as $temp_item){
                if($temp_item->product_id == $product_id){
                    if($temp_item->count < $count){
                        $temp_item->count =$count;
                        $temp_item->save();
                    }
                $exist=true;
                break;
                }
             }
            }
            //不存在的  需要进行存储
            if($exist == false){
                $cart_item = new cart_item;
                $cart_item ->member_id = $member_id;
                $cart_item ->product_id = $product_id;
                $cart_item ->count = $count;
                $cart_item ->save();
                array_push($cart_item_arr,$cart_item);
            }
    }
        

        //添加产品对象的显示
        $cart_items = cart_item::where('member_id',$member_id)->get();
        foreach($cart_items as $cart_item){
            $cart_item->product = product::find($cart_item->product_id);
            array_push($cart_item_arr,$cart_item);
        }
        return $cart_item_arr;
     }

     public function deleteCart(Request $request){
            $product_id = $request->input('product_id','');
            if($product_id==''){

                return  response()->json(20,200);
            }
            $product_id_arr = explode(',',$product_id);



            //用户已登录的删除情形
            $member = $request->session()->get('member','');//查找session中的用户
            if($member!=''){
                $cart_items = cart_item::where('member_id',$member->id)->get();//通过查找用户id相同  查找相应的购物车数据库数据
                foreach ($cart_items as $cart_item) {//循环删除商品id相同的数据
                    //存在  则删除
                   if(in_array($cart_item->product_id,$product_id_arr)){
                    cart_item::where('product_id',$cart_item->product_id)->delete();
                    } 
                }
                return  response()->json(28,200);          
                }
               
            

            $cart = $request->cookie('cart'); 
            $cart_arr = $cart!=null ? explode(',', $cart) : array();
            foreach($cart_arr as $key => $value){
                $index = strpos($value,':');
                $product_id = substr($value,0,$index);
                //$count = substr($value,$index); 存在-删除
                if(in_array($product_id, $product_id_arr)){//在产品id数组中查找产品id是否存在
                    array_splice($cart_arr, $key,1);//array_splice() 函数从数组中移除选定的元素，并用新元素取代它
                    continue;
                }
            }
            //当删除点击执行成功之后 需要重新设置cookie 
            $cart_arrs = implode(',', $cart_arr);
            return response()->json($cart_arrs,200)
                             ->withCookie('cart',$cart_arrs);
     }
     public function toOrderSubmit(Request $request,$product_ids){
        $product_id_arr = $product_ids!='' ? explode(',', $product_ids) : array();
        $member = $request->session()->get('member','');//获取用户的member id
        $cart_items = cart_item::where('member_id',$member->id)->whereIn('product_id',$product_id_arr)->get();//在购物车中  首先使用memberid获取用户id所对应的数据  再通过商品id查询product_ids所对应的产品信息  再获取购物车的列表
        $cart_item_arr = array();
        $total_price = 0;
        $order = new order;
        $order->member_id =  $member->id;
        $name='';
        $order->save(); 
        foreach ($cart_items as $cart_item) {//通过foreach循环来显示我们的视图。
            $cart_item->product = product::where('id',$cart_item->product_id)->first();
            if($cart_item->product!=null){//如果商品信息不存在，可以采用添加的方式，将商品信息添加进来
                $total_price+=$cart_item->product->price*$cart_item->count;
                $name.='《'.$cart_item->product->name.'》';
                array_push($cart_item_arr, $cart_item);
            }
                $order_item = new order_item;
                $order_item ->order_id = $order->id;
                $order_item ->product_id=$cart_item->product_id;
                $order_item ->count=$cart_item->count;
                $order_item ->product_snapshot=json_encode($cart_item->product);
                $order_item ->save();
        }
        //删除购物车中的订单信息
        cart_item::where('member_id',$member->id)->delete();

        $int=rand(100000,999999);
        $font="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $time=time();
        $code=$font[rand(0,26)].$font[rand(0,26)].$font[rand(0,26)].$font[rand(0,26)].$time.$int;
        $order->order_no = $code ;
        $order->name=$name;
        $order->total_price=$total_price;
        $order->save(); 

         
        //return $cart_item_arr;
        return view('order_submit')->with('cart_items',$cart_item_arr)
                                    ->with('total_price',$total_price)
                                    ->with('product_ids',$product_id_arr);
     }



     public function toOrderList(Request $request,$product_ids){
        $product_id_arr = $product_ids!='' ? explode(',', $product_ids) : array();
        $member = $request->session()->get('member','');//查询用户信息
        $member_id = $member->id;
        $cart_items = cart_item::where('member_id',$member->id)->whereIn('product_id',$product_id_arr)->get();
        //return $cart_items;
        $cart_item_arr = array();
        $total_price = 0;
        $total_count=0;
        $count_arr=array();
        foreach ($cart_items as $cart_item){
            $cart_item->product = product::where('id',$cart_item->product_id)->first();
           if($cart_item->product!=null){
                $total_price+=$cart_item->product->price*$cart_item->count;
                $total_count+=$cart_item->count;
                array_push($cart_item_arr,$cart_item);
            }}
           
        //  if($cart_items!=null&&$cart_items!=''){
        //      $order = new order;
        //      $order->member_id =  $member_id;
        //      $order->total_price=$total_price;
        //      $order->save(); 
        //   } 
        //  }
          //foreach ($cart_items as $cart_item){
           //if($cart_items!=null&&$cart_items!=''){
            //    $order_item = new order_item;
             //   //$order_item ->order_id = $order->id;
             //   $order_item ->product_id=$cart_item->product_id;
             //   $order_item ->count=$cart_item->count;
              //  $order_item ->save();
           // }
           // }
        $orders = order::where('member_id',$member->id)->get();//根据memberid查询订单列表信息

        foreach($orders as $order){
            $order_items = order_item::where('order_id',$order->id)->get();
            $order->order_items = $order_items;//把order_items作为属性放到order里面
            foreach($order_items as $order_item){
                $order_item->product = product::where('id',$order_item->product_id)->first();  
            } 
        }
        //return $orders;
  
        return view('order_list')->with('orders',$orders)
                                 ->with('cart_items',$cart_item_arr)
                                 ->with('total_count',$total_count);
     }
}