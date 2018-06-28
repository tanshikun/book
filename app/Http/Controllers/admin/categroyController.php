<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Entity\categroy;
use App\Entity\product;
use App\Entity\product_content;
use App\Entity\product_images;
use App\Models\Result;
use Illuminate\Http\Request;

class categroyController extends Controller
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
   public function toCategroyAdd(){
      $categries = categroy::whereNull('parent_id')->get();
    return view('admin.categroy_add',['categries'=>$categries]);
   }
   public function toCategroyTypeAdd(){
      $names =$_POST['name'];
      $categroy_no=$_POST['categroy_no'];
      $parent_id=$_POST['parent_id'];
      
       if($names==null&&$names==''){
            return response()->json('请认真填写类别名称',200);//请认真填写类别名称
          }
        if($categroy_no==null&&$categroy_no==''&&$categroy_no<1){
            return response()->json('请重新填写类别编号',200);//请重新填写类别编号
          }
        $categroy = new categroy;
        $categroy->name = $names;
        $categroy->categroy_no =$categroy_no;
        if($parent_id!=''&&$parent_id!=null){
            $categroy->parent_id =$parent_id;
          }
        $categroy->save();
        return response()->json('添加成功！',200);//添加成功 

        
   }

    

    public function toCategroyTypeDel(){
        $id=$_POST['id'];
        categroy::where('id',$id)->delete();
        return response()->json(9,200);//删除成功
    }
    public function toProduct(){
        $products = product::all();
        foreach ($products as $product) {
            if($product->categroy_id!=''&&$product->categroy_id!=null){
                $product->parent = categroy::where('id',$product->categroy_id)->first();
            }
        }
        return view('admin/product')->with('products',$products);
    }
    public function toProductContent(Request $Request,$id){
        $products = product_content::where('id',$id)->first();
        $product_id= $products->product_id;
        $product=product::where('id',$product_id)->first();
        $products->product=$product;
        $categroy=categroy::where('id',$product->categroy_id)->first();
        $products->product->categroy=$categroy;
        $images=product_images::where('product_id',$product->id)->get();
        //return response()->json($images);
        //return response()->json($products);
        return view('admin/product_content')->with('products',$products)
                                            ->with('images',$images);
    }
    public function toProductAdd(){
        $categries=categroy::whereNull('parent_id')->get();
        //return response()->json($categries);
        return view('admin/product_add',['categries'=>$categries]);
    }
    public function ProductAdd(){
    
    }
    public function categroyEdit(Request $Request){
        $id = $Request->input('id','');
        $categries=categroy::whereNull('parent_id')->get();
        //return response()->json($categries);
        $categroy=categroy::where('id',$id)->first();
        //return response()->json($categroy);
        return view('admin/categroy_edit')->with('categroy',$categroy)
                                          ->with('categries',$categries);
    }
    public function toCategroyEdit(Request $request){
        $id = $request->input('id','');
        $categroy=categroy::find($id);
        //return response()->json($categroy);
        
        $name = $_POST['name'];
        $categroy_no = $_POST['categroy_no'];
        $parent_id=$_POST['parent_id'];

        
        $categroy->name = $name;
        $categroy->categroy_no =$categroy_no;
        if($parent_id!=''&&$parent_id!=null){
            $categroy->parent_id =$parent_id;
        }
        $categroy->save();
        return response()->json(8,200);//修改成功
    }
    public function product_add($id){
      $categroys = categroy::where('parent_id',$id)->get(); 
      return response()->json($categroys,200);
    }
}
