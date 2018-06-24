<?php
/**
 * @Author: anchen
 * @Date:   2018-06-16 11:01:22
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-06-16 11:15:25
 */
namespace App\Models;
/**
* 
*/
class email{
    public $from;//发件人邮箱
    public $to;//收件人邮箱
    public $cc;//抄送
    public $attach;//附件
    public $subject;//主题
    public $content;//内容

}