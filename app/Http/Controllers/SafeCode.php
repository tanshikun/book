<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
include "d:/phpstudy/phptutorial/www/mylaravels/book/vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;


class SafeCode extends Controller
{
    public function safecode(){
		$builder = new CaptchaBuilder;
		$builder->build();
		header('Content-type: image/jpeg');
		$builder->output();
        $ses= $builder->getPhrase();//获取composer生成的验证码中的值
        session(['safe_code'=>"$ses"]);//safe_code对应的验证码中的值
	}
	
}
