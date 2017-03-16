@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">QR-CODE</div>

                <div class="panel-body">
                         <img src={{$user}} width="200" height="200">
                         <p>Step1:請用手機APP-Authenticator掃描這個QR-Code</p>
                         <p>Step2:將QR-Code圖片儲存下來</p>
                         <p>Step3:進行二次驗證囉→
                        <a href="{{ url('secondVerify') }}">點選此連結</a></p>
               </div>
        </div>
    </div>
</div>
@endsection
