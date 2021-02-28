@extends('layouts/app')

@section('content')
<div class="overflow-hidden">
  <div id='map'></div>
  <div class="location-container absolute sm:w-2/3 flex-col items-center">
    <div class="flex items-baseline">
      <h1 class="py-4 m-0 text-opacity text-base sm:text-xl">Most popular</h1>
      <a class="font-bold text-primary dotted-underline text-base pt-4  ml-auto" href="{{ route('car/latest') }}">Latest</a>
    </div>
    <div class="overflow-x-scroll flex w-auto" id="locations" style="border: 1px var(--dark-grey) solid;"></div>
  </div>
</div>
<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoieHNhbWJyb2NrIiwiYSI6ImNraWYxaHplYzBhOTYzMHFrZGVjbmk2azYifQ.YvpDpSvqa6V1SC3EVEEG3A';
  const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/xsambrock/ckjgbfh5besn219nj2qe120cm',
    center: [-3.756586, 42.558860],
    zoom: 3,
    minZoom: 3
  });

  const nav = new mapboxgl.NavigationControl();
  map.addControl(nav, 'bottom-left');
</script>
@endsection