<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Entity\categroy;
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
   public function toCategroyTypeAdd(Request $request){
      $name =$request->input('name','');
      $categroy_no=$request->input('categroy_no','');
      $parent_id=$request->input('parent_id','');
      if($name==null&&$name==''){
        return response()->json(6,200);//请认真填写类别名称
      }
      if($categroy_no==null||$categroy_no==''||$categroy_no<1){
        return response()->json(7,200);//请重新填写类别编号
      }
      $categroy = new categroy;
      $categroy->name =$name;
      $categroy->categroy_no =$categroy_no;
      if($parent_id!=''){
        $categroy->parent_id =$parent_id;
      }
      $categroy->save();
      return response()->json(8,200);//添加成功
   }
}
