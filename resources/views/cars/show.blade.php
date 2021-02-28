@extends('layouts.app')

@section('title', "{$car->car_name} |")

@section('content')
<section class="pt-12 sm:pt-inherit">
  <div class="flex flex-col">
    <div class="grid grid-cols-2">
      @if (Gate::any(['update', 'delete'], $car))
      <h1 class="heading mt-auto ">{{$car->car_name}}</h1>
      <div class="ml-auto">
        <a href="{{ route('car/edit', ['car' => $car->id]) }}"><i class="material-icons mr-2 icon-btn">create</i></a>
        <a href="{{ route('car/delete', ['car' => $car->id]) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();"><i class="material-icons mr-2 icon-btn">clear</i></a>
        <form id="delete-form" action="{{ route('car/delete', ['car' => $car->id]) }}" method="POST" class="hidden"> @csrf @method('DELETE') </form>
      </div>
      @else
      <h1 class="heading mt-auto col-span-2">{{$car->car_name}}</h1>
      @endif
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2">
      <div class="grid grid-cols-2 sm:flex items-start">
        <span class="font-semibold text-grey flex items-center"><i class="material-icons mr-2">schedule</i>{{\Carbon\Carbon::parse($car->created_at)->toFormattedDateString()}}</span>
        <span class="font-semibold text-grey flex items-center col-span-2 row-start-2 mt-3 sm:ml-6 sm:mt-0"><i class="material-icons mr-1">location_on</i>{{$car->location()}}</span>
        <a class="font-semibold text-primary flex items-center sm:ml-6" href="{{ route('user/show', ['user' => $car->user->id]) }}"><i class="material-icons mr-2">camera_alt</i>{{$car->user->name}}</a>
      </div>
      <div class="text-grey font-medium w-full break-words mt-6 sm:mt-0">{{$car->description}}</div>
    </div>
  </div>
  @foreach($car->uploads as $image)
  <div class="w-full flex overflow-hidden my-12 relative" style="background: var(--white-light2); max-height: 800px; max-width: 100%;">
    <img src="{{$image->url}}" alt="{{$car->car_name}}" class="h-auto w-full m-auto object-contain sm:h-full" style="max-height: 800px" />
  </div>
  @endforeach
</section>
@endsection