<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QrCode;
use Google2FA;
class RegisterSecondVerifyController extends Controller
{
    //
    
    public function __construct()//查看使用者是否為
    {
        $this->middleware('auth');
    }

    
    
    public function generateQRcodeIndex()
    {
    	$user=Auth::user();
        $user->google2fa_secret = Google2FA::generateSecretKey();
        $user->save();
        $google2fa_url= Google2FA::getQRCodeGoogleUrl(
               'test',
               $user->email,
               $user->google2fa_secret
         );
        //$key=this.generateKey();
       
    	//dd($google2fa_url);
    	//$aa=QrCode::generate('$user->id');
    	return view('generateQRcode',['user'=>$google2fa_url]);

    }

}
