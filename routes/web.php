<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('registerSecond','RegisterSecondVerifyController@generateQRcodeIndex');//二次註冊驗證
Route::get('secondVerify','SecondVerifyController@Index');//二次登入驗證
Route::post('secondVerifyEnter','SecondVerifyController@verifyUser');//送出二次驗證資料
Route::get('mapUserAddress','MapUserAddressController@index');//google map
