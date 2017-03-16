<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MapUserAddressController extends Controller
{
    //
    public function __construct()//查看使用者是否為
    {
        $this->middleware('isauth');
    }
    public function index()
    {
    	return view('mapUser');
    }
}
