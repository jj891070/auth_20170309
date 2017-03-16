
<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 500px;
        width: 700px;
      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

    </style>
    <title>Places Searchbox</title>
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>
  <div class="container">
     <div class="row">
        <div class="col-md-8 col-md-offset-2">  
                  <div class="form-group">
                  <a href="{{ url('/') }}">回首頁</a> | <a href="{{ url('/home') }}">回家目錄</a>
                  </div> 
                             
                  <input id="pac-input" class="controls" type="text" placeholder="Search Box">
             
                  <div class="form-group">
                       <div id="map"></div>
                  </div>
                  <div class="form-group">
                       <div id="floating-panel">
                         <input onclick="clearMarkers();" type=button value="Hide Markers">
                         <input onclick="showMarkers();" type=button value="Show All Markers">
                         <input onclick="deleteMarkers();" type=button value="Delete Markers">
                         <input onclick="dataClear();" type=button value="畫三角形">
                       </div>
                                </div>
                        <div class="form-group">
                              <label for="">緯度(Lat)</label>
                              <input type="text"  name="lat" id="lat">
                        </div>
              
                        <div class="form-group">
                              <label for="">經度(Lng)</label>
                              <input type="text"  name="lng" id="lng">
                        </div>
                        <div class="form-group">
                              <label for="">經度|緯度: </label>
                        </div>
                        <div class="form-group">
                              <div id="textarea1"></div>
                        </div>
         </div>
      </div>
  </div>
<script>

// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
var map;
var markers = [];
var haightAshbury = {lat: 24.1465218, lng: 120.674334};
var lat;
var lng;
var triangleCoords=[];
var num=0;
var bermudaTriangle;
var data=new Array();
var x=0;
var y=1;
var z=2;
var add;
function initAutocomplete() {
    map = new google.maps.Map(document.getElementById('map'), {
    center:{
              lat:24.1465218,
              lng:120.674334
            },
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP

  });
  var drawingManager = new google.maps.drawing.DrawingManager({
                         drawingMode: null,
                         drawingControl: true,
                         drawingControlOptions: {
                           position: google.maps.ControlPosition.TOP_CENTER,
                           drawingModes: [
                             
                             google.maps.drawing.OverlayType.CIRCLE,
                             google.maps.drawing.OverlayType.POLYGON,
                             google.maps.drawing.OverlayType.POLYLINE,
                             google.maps.drawing.OverlayType.RECTANGLE
                           ]
                         },
                        
                         
                         circleOptions: {
                           fillColor: '#ffff00',
                           fillOpacity: 1,
                           strokeWeight: 5,
                           clickable: false,
                           editable: true,
                           zIndex: 1
                         }
                       });
  drawingManager.setMap(map);

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

 

  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));
      
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
    
  });

  // This event listener will call addMarker() when the map is clicked.
  map.addListener('click', function(event) {
     addMarker(event.latLng);
  });
  
  // Adds a marker at the center of the map.
  addMarker(haightAshbury);
  // [END region_getplaces]
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  lat=marker.getPosition().lat();
  lng=marker.getPosition().lng();
  $('#lat').val(lat);
  $('#lng').val(lng);
  if(num<3)
  {
      data[num] = new Array();
      data[num][x]=lat;
      data[num][y]=lng;
      add = $('#textarea1').html() + ' 緯度( '+lat.toString(10)+')  經度('+ lng.toString(10)+') <br>';
      $('#textarea1').html(add);
      if(num==2)
      {
        draw();
      }
      console.log(num);
      num++;
  }
  
  markers.push(marker);
}

function draw()
{
     triangleCoords = [
      {lat: data[x][x], lng: data[x][y]},
      {lat: data[y][x], lng: data[y][y]},
      {lat: data[z][x], lng: data[z][y]}
       ];
       console.log(data);
     bermudaTriangle = new google.maps.Polygon({
          paths: triangleCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: '#FF0000',
          fillOpacity: 0.35
    });
   bermudaTriangle.setMap(map);
}
// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {

    markers[i].setMap(map);

  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
  num=6;
  
}
function dataClear()
{
  $('#textarea1').html('');
  num=0;
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkpTW0BYW9k8rO_1yJaVhF6FnITQZS_14&libraries=places,drawing&callback=initAutocomplete&signed_in=true"
         async defer></script>

  </body>

</html>
