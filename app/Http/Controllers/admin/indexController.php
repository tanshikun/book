<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

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
}
