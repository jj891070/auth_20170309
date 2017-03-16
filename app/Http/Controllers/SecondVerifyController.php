<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use QrCode;
use Google2FA;
class SecondVerifyController extends Controller
{
	
	public function __construct()//查看使用者是否為使用者
    {
        $this->middleware('auth');
    }
    public function index()//user輸入要驗證的方法
    {
        $user=Auth::user();
        if($user->second_verify==1){
            return redirect('/mapUserAddress');
        }
        
        return view('secondVerify');
    }
    public function verifyUser(Request $req)
    {
    	$user=Auth::user();
        
        $method=$req->input('method');
       //dd($qr_img );
        if($method=="q"){ 
        	// dd(storage_path('/'));
        	$filename = 'aa.png';
        	$path = 'app/';
        	$qr_img=$req->file('file1')->move(storage_path($path), $filename);
        	// dd(storage_path($path.$filename));
        	$QRCodeReader = new \Libern\QRCodeReader\QRCodeReader();
            $qrcode_text = $QRCodeReader->decode(storage_path($path.$filename));
            $valid = str_contains($qrcode_text, $user->google2fa_secret);
           
              if($valid==true){
        	 	$user->second_verify=1;
        	 	$user->save();
        	 	return redirect('/mapUserAddress');
        	 }else{
                 return redirect('secondVerify')->with('error', '驗證失敗');
             }
         }else{ 
         	 $secret_key=$req->input('secretkey');
             $valid = Google2FA::verifyKey($user->google2fa_secret, $secret_key);
        	 if($valid==true){
        	 	$user->second_verify=1;
        	 	$user->save();
        	 	return redirect('/mapUserAddress');
        	 }else{
                return redirect('secondVerify')->with('error', '驗證失敗');
             }
         } 
       //
    }
    
}
