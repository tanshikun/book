<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Entity\admin;
class loginController extends Controller
{

    public function toLogin(){
            $usernamess = $_POST['name'];
            if($usernamess==null&&$usernamess==''){
                return response()->json(1,200);
            }
            $password = $_POST['password'];
            if($password==null&&$password==''){
                return response()->json(2,200);
            }
            $admin = admin::where('admin',$usernamess)->first();
            if($admin==null){
                return response()->json(3,200);
            }
            if($password!=$admin->password){
                return response()->json(4,200);
            }
            session(['admin'=>$admin]);
            return response()->json(5,200);
        }
   }

