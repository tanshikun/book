<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Entity\product;
use App\Entity\product_content;
use App\Entity\product_images;
use App\Entity\categroy;
use Illuminate\Http\Request;

class contentController extends Controller
{
   public function productadd(){
        $content = $_POST['content'];
        $names = $_POST['name'];
        $parent_id = $_POST['parent_id'];
        $id=$_POST['id'];
        $summary=$_POST['summary'];
        $price=$_POST['price'];

        $fileSize='2';
        $path="D:/phpStudy/PHPTutorial/WWW/mylaravels/book/public";
        $uploadPath="/images/";
        $fileType="image/jpeg|image/png|image/gif";
        $controlName="image";

        if(!file_exists($uploadPath)){
            mkdir($uploadPath);
        }
        if(is_uploaded_file($_FILES[$controlName]['tmp_name'])){
            $type = $_FILES[$controlName]['type'];
            $arrType = explode("|", $fileType);
            if(!in_array($type, $arrType)){
                return response()->json('上传文件类型不符',200);
            }
            $size = $_FILES[$controlName]['size'];
            if($size > $fileSize*1024*1024){
                return response()->json("上传大小限制，最大允许：".$fileSize."Mb",200);
            }
            $arrName = explode(".", $_FILES[$controlName]['name']);
            $name = $arrName[count($arrName)-1];
            $newName = sha1(microtime()).".".$name;
            if(move_uploaded_file($_FILES[$controlName]['tmp_name'],$path.$uploadPath.$newName)){
                
                if($names==null&&$names==''){
                    return response()->json('请认真填写产品名称！',200);
                }
                $product = new product;
                $product->name = $names;
                $product->summary = $summary;
                if($price==null&&$price==''){
                    $product->price=0;
                }
                $product->price = $price;
                $product->preview = $uploadPath.$newName;
                $product->categroy_id=$id;
                $product->save();
                $product_content = new product_content;
                $product_content->content = $content;
                $product_content->product_id=$product->id;
                $product_content->save();
                $product_images=new product_images;
                $product_images->image_path=$uploadPath.$newName;
                $product_images->product_id=$product->id;
                $product_images->save();
                return response()->json('保存成功',200);
            }else{
                return response()->json('图片上传失败！',200);
            }
        }
   }

   public function productEdit($id){
        //首先通过商品id查询一条商品数据  名称 简介 价格 图片路径可通过$product回选
        $product=product::where('id',$id)->first();
        //通过商品数据父级id查处二级类别的一条数据  二级类别对应id：$categroy_two->id
        $categroy_two=categroy::where('id',$product->categroy_id)->first();
        //通过二级类别的parent_id查出对应的一级类别  一级类别对应id：$categroy_one->id
        $categroy_one=categroy::where('id',$categroy_two->parent_id)->first();
        //查出所有一级类别  循环便利一级类别
        $categries = categroy::whereNull('parent_id')->get();
        //通过procuct中的id查出product_content中的product_id相对于的数据
        $product_content=product_content::where('product_id',$product->id)->first();

 
        return view('admin/product_edit')->with('product',$product)
                                        ->with('categries',$categries)
                                        ->with('categroy_one',$categroy_one)
                                        ->with('categroy_two',$categroy_two)
                                        ->with('product_content',$product_content);
   }
    public function product_edit(Request $request){
        $content = $_POST['content'];
        $names = $_POST['name'];
        $parent_id = $_POST['parent_id'];
        $id=$_POST['id'];
        $summary=$_POST['summary'];
        $price=$_POST['price'];
        $product_id=$_POST['product_id'];
        //return $product_id;
        $image=is_uploaded_file('image');
        if($image==null||$image==''){
            if($names==null&&$names==''){
                    return response()->json('请认真填写产品名称！',200);
                }
                $product=product::where('id',$product_id)->first();
                $product->name = $names;
                $product->summary = $summary;
                if($price==null&&$price==''){
                    $product->price=0;
                }
                $product->price = $price;
                $product->categroy_id=$id;
                $product->save();

                $product_content=product_content::where('product_id',$product->id)->first();
                $product_content->content=$content;
                $product_content->product_id=$product->id;
                $product_content->save();

                return response()->json('保存成功',200);
        }
        $fileSize='2';
        $path="D:/phpStudy/PHPTutorial/WWW/mylaravels/book/public";
        $uploadPath="/images/";
        $fileType="image/jpeg|image/png|image/gif";
        $controlName="image";

        if(!file_exists($uploadPath)){
            mkdir($uploadPath);
        }
        if(is_uploaded_file($_FILES[$controlName]['tmp_name'])){
            $type = $_FILES[$controlName]['type'];
            $arrType = explode("|", $fileType);
            if(!in_array($type, $arrType)){
                return response()->json('上传文件类型不符',200);
            }
            $size = $_FILES[$controlName]['size'];
            if($size > $fileSize*1024*1024){
                return response()->json("上传大小限制，最大允许：".$fileSize."Mb",200);
            }
            $arrName = explode(".", $_FILES[$controlName]['name']);
            $name = $arrName[count($arrName)-1];
            $newName = sha1(microtime()).".".$name;
            if(move_uploaded_file($_FILES[$controlName]['tmp_name'], $path.$uploadPath.$newName)){
                
                if($names==null&&$names==''){
                    return response()->json('请认真填写产品名称！',200);
                }
                $product=product::where('id',$product_id)->first();
                $product->name = $names;
                $product->summary = $summary;
                if($price==null&&$price==''){
                    $product->price=0;
                }
                $product->price = $price;
                $product->preview = $uploadPath.$newName;
                $product->categroy_id=$id;
                $product->save();

                $product_content=product_content::where('product_id',$product->id)->first();
                $product_content->content=$content;
                $product_content->product_id=$product->id;
                $product_content->save();

                $product_images=product_images::where('product_id',$product->id)->first();
                $product_images->image_path=$uploadPath.$newName;
                $product_images->product_id=$product->id;
                $product_images->save();
                return response()->json('保存成功',200);
            }else{
                return response()->json('图片上传失败！',200);
            }
        }
   }

   public function product_del(Request $request){
        $id = $request->input('id','');
        $product=product::where('id',$id)->first();//获得product表中的对应id的数据
        $preview=$product->preview;
        $path="D:/phpStudy/PHPTutorial/WWW/mylaravels/book/public";
        $images_path=$path.$preview;//获得图片的绝对路径
        
        //通过product id获取商品图片表中的数据
        $product_images=product_images::where('product_id',$id)->get();
        foreach($product_images as $product_image){
            $image_path = $product_image->image_path;
            unlink($path.$image_path);
            product_images::where('product_id',$id)->delete();
        }
        //通过product id获取商品详情表中的数据并删除
        $product_content=product_content::where('product_id',$id)->delete();
        $product=product::where('id',$id)->delete();//获得product表中的对应id的数据并删除
        return response()->json(9,200);
   }
}
