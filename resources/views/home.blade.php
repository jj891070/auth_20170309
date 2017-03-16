@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>歡迎光臨</h2></div>

                <div class="panel-body">
                    你已登入本系統囉!</br>
                    讓我們一起來使用google map吧^.^</br>
                    <a href="{{ url('mapUserAddress') }}">點選此連結</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
