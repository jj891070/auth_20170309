<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkpTW0BYW9k8rO_1yJaVhF6FnITQZS_14&callback=initMap">
        </script>
        <title>中佑資訊</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #map {
                height: 500px;
                width: 1800px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    中佑資訊
                </div>
                
                <div class="links">
                    <hr color="#000000" size="5" width="1800px"  align="center">
                    <div id="map"></div>
                    <hr color="#000000" size="5" width="1800px"  align="center">
                    <a href="mapUserAddress"><h3>Google map</h3></a>
                    
                </div>
                <marquee onMouseOver="this.stop()"  onMouseOut="this.start()" scrollamount="10" style="font-family:標楷體;color:yellow;"id=mql
                     align="top" loop="-1" behavior="scroll" bgcolor="#000000"
                     height="50" width="1800" direction="left" >
                     <h3>"google map & 二次驗證":點上面google map連結，方可登入系統唷^.^</h3>
                </marquee>
            </div>
        </div>
    </body>
    <script>
           function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 24.1465218, lng: 120.674334},
                disableDefaultUI: true
               });
            }
    </script>
</html>
