<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexController extends Controller
{
   public function login(){
        return redirect('admin/index');
   }
    public function toLogin(){
        return view('admin/login');
   }
    public function toIndex(){
        return view('admin/index');
   }
   public function welcome(){
        return view('admin/welcome');
   }
   public function exist_login(Request $request){
        $admin = $request->session()->get('admin','');
        if($admin!=null&&$admin!=''){
            session('admin','');
        }
        return view('admin/login');
   }
}
