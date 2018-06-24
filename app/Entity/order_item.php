<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    protected $table = 'order_item';
    protected $primarykey = 'id';
     public $timestamps = false;
}
