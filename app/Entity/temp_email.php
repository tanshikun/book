<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class temp_email extends Model
{
    protected $table = 'temp_email';
    protected $primarykey = 'id';
    public $timestamps = false;
}