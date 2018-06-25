<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\tool\sms\sendTemplateSMS;
use App\Entity\temp_phone;
use App\Entity\temp_email;
use App\Entity\member;
use App\Models\email;
use App\Tool\UUID;
use Resourses\views\email_register;
use Mail;
use Illuminate\Http\Request;
class memberController extends Controller
{
    public function toLogin(Request $request){
        $return_url = $request->input('return_url','');
        return view('login')->with('return_url',urldecode($return_url));
    }


    public function toRegister(){
        return view('register');
    }



    public function ajax_tel(){
        $post_phone=$_POST['phone'];   
        if($post_phone==''||strlen($post_phone)!=11||substr($post_phone,0,1)!=1){
                    return response()->json(1,200);//手机号码格式不符
            }
        $temp_phone = temp_phone::where('phone',"$post_phone")->first();//处理重复发送验证码的情况
        if($temp_phone == null){
            $temp_phone = new temp_phone();
        }
        //新建一条记录
        $temp_phone ->phone=$post_phone;
        $code_value = rand(1000,9999);//随机验证码
        $temp_phone ->code= $code_value;
        $temp_phone -> save();//保存
        $code=urlencode("#code#=$code_value");//给随机验证码加密
        //$res=file_get_contents("http://v.juhe.cn/sms/send?mobile=$post_phone&tpl_id=82739&tpl_value=$code&key=dca53ad5760be418636afe1e5cf6107e");//短信接口
        return response()->json("ok",200);    
    }
    public function ajax_email(){
        $emails=$_POST['emails'];//用户提交的邮箱地址
        if($emails==''){
            return response()->json(6,200);//邮箱输入不正确
        }
        $temp_email = temp_email::where('member_id',"$emails")->first();//取出一条temp_email表中对应member_id字段的数据
        if($temp_email == null){
            $temp_email = new temp_email();//验证码重复发送问题
        }
        $temp_email ->member_id = $emails;
        $code_value = rand(1000,9999);
        $temp_email ->code= $code_value;//随机验证码
        $temp_email -> save();//保存->讲用户邮箱和生成的验证码保存到数据库的temp_email表中
        //$code=urlencode("#code#=$code_value");//给随机验证码加密
        //
        $email = new email;
        $email->to = $emails;
        $email->cc = '1104300042@qq.com';
        $email->subject = '书城验证';
        $email->content = "验证码：".$code_value."。请于5分钟内完成验证。";
        Mail::send('email_register', ['email' => $email], function ($m) use ($email) {
            $m->to($email->to, '尊敬的用户')
              ->cc($email->cc)
              ->subject($email->subject);
        });
        return response()->json('email ok',200);
    }
    public function logup(){//判断用户使用的是手机注册还是邮箱注册
        if ($_POST['mode']=='tel') {//手机注册用户提交数据至数据库
            //判断用户提交的验证码和短信平台发送的验证码是否相符
            $phone = $_POST['tel'];//获取用户提交的phone的值
            if($phone==''||$phone==null){
                return response()->json(101,200);
            }
            $phone_phone = temp_phone::where('phone',"$phone")->first();//通过where从数据库的temp_phone表中取出一条phone字段为用户提交的号码的数据
            $member_tel = member::where('phone',"$phone")->first();
            if($member_tel!=null){
                return response()->json(3,200);//此用户注册过
            }
            $code = $_POST['code'];//获取用户上传的code
            $phone_code = $phone_phone -> code;//从这条数据中取出字段为code所对应的值,保存在phone_code中
            if($phone_code==''||$phone_code==null){
                return response()->json(102,200);
            }
            if($code!=$phone_code||$code==''||strlen($code)!=4){
                return response()->json(2,200);//验证码不正确
            }else{
                
                $member = new member();
                $times= date('YmdHis',time());//先给用户昵称一个时间戳
                $member ->nickname =$times;
                $member ->phone = $_POST['tel'];
                $password1 = $_POST['password'];
                if($password1==''||strlen($password1)<6){
                    return response()->json(4,200);//密码不能低于6位
                }
                $member ->password = sha1($password1);
                $member ->save();
                return response()->json(5,200);//注册成功
            }
            return response()->json('tel',200);
        }else{//邮箱注册用户提交数据至数据库
            $email = $_POST['emails'];
            if($email==''||$email==null){
                return response()->json(101,200);
            }
            $temp_email = temp_email::where('member_id',"$email")->first();
            $member_email = member::where('email',"$email")->first();
            if($member_email!=null){
                return response()->json(9,200);//此用户注册过
            }
            $code = $_POST['code'];
            $temp_code = $temp_email->code;
            if($temp_code==''||$temp_code==null){
                return response()->json(102,200);
            }
            if($code==''||strlen($code)!=4||!$code==$temp_code){
                return response()->json(6,200);//验证码输入不正确
            }else{
                $member = new member();
                $times= date('YmdHis',time());//先给用户昵称一个时间戳
                $member ->nickname =$times;
                $member ->email=$_POST['emails'];
                $password1 = $_POST['password'];
                if($password1==''||strlen($password1)<6){
                    return response()->json(7,200);//密码不能低于6位
                }
                $member ->password = sha1($password1);
                $member ->save();
                return response()->json(8,200);//注册成功
            }
            return response()->json('email',200);
        }
    }
    public function ajax_on_login(){ 
        $safe_code_value = session('safe_code');//通过session获取laravel框架自动生成的验证码的值
        $safe_code = $_POST['safe_code'];
        if($safe_code==null||$safe_code!=$safe_code_value){
            return response()->json(11,200);//验证码输入不正确
        }
        //判断验证码输入是否正确
        $user_name = $_POST['user_name'];
        if($user_name==null){
            return response()->json(12,200);//用户名不能为空
        }
        //查询用户名字段中是否有@，有则是邮箱，无 则是手机
        if(strpos($user_name,'@')==true){
            $member = member::where('email',"$user_name")->first();
        }else{
            $member = member::where('phone',$user_name)->first();
        }
        if($member==null){
            return response()->json(14,200);//用户名不存在
        }else{
            //判断密码是否正确
            $password = sha1($_POST['password']);
            //$member = member::where('password',"$password")->first();
            $password_tel = $member->password;
            if($password_tel!=$password){
                return response()->json(13,200);//输入密码不正确
            }
        }     
        session(['member'=>$member]);
        return response()->json(15,200);
    }
}