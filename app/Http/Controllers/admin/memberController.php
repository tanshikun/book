<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Entity\member;


class memberController extends Controller
{
    public function toMember(){
        $members=member::all();
        return view('admin/member')->with('members',$members);
    }

}
