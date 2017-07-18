<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiddlewareController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function iya ()
    {
    $a= "ananda";
    return "Nama Saya :".$a;
	}

}
