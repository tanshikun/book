<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $primarykey = 'id';
    public $timestamps = false;
}
