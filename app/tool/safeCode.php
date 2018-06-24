<?php
/**
 * @Author: anchen
 * @Date:   2018-06-11 18:57:30
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-06-11 19:01:17
 */
include "vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;
$builder = new CaptchaBuilder;
$builder->build();
header('Content-type: image/jpeg');
$builder->output();