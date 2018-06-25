<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $status;
    public $message;
    //public function toJson(){
     //   return json_encode($this,JSON_UNESCAPED_UNICODE);
    //}
}
