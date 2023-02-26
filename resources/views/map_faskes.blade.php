@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Peta Faskes
@endsection

@section('mapFaskesStatus')
active
@endsection

@section('content')
<div class="container-fluid">
    <div id = "map" style = "margin-top:0!important;width:100%;height:80vh"></div>
</div>
@endsection

@section('script')
<script src = "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet-src.min.js"></script>
<script>
  
  // Creating a map object
  var mapOptions = {
    center: [-7.2794, 112.7484],
    zoom: 12,
    wheelDebounceTime: 40
  }
  var map = new L.map('map', mapOptions);
  var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
  map.addLayer(layer);
  
  // create a red polyline from an array of LatLng points
  // var latlngs = [
  //     [-7.2794, 112.7484],
  //     [-7.27, 112.43],
  //     [-7.27, 112.2],
  //     [-7.2794, 112.7484],
  // ];

  // var polyline = L.polyline(latlngs, {color: 'blue'}).addTo(map);

  // zoom the map to the polyline
  // map.fitBounds(polyline.getBounds());
  
  @foreach($faskes as $unit)
  // Creating a marker
  var marker = new L.Marker([{{$unit->coord_x}}, {{$unit->coord_y}}]);
  marker.addTo(map);
  marker.bindPopup('{{$unit->nama}}');
  @endforeach
</script>
@endsection
