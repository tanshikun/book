<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class product_images extends Model
{
    protected $table = 'product_images';
    protected $primarykey = 'id';
    public $timestamps = false;
}
