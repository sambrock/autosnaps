<div>
  <a href="{{ route('car/show', ['car' => $car->id]) }}">
    <div class="w-auto overflow-hidden grid relative" style="height: 500px">
      <img src="{{ $car->uploads[0]->url ?? asset('images/no-photo.png') }}" alt="{{ $car->car_name }}" class="center-img" />
    </div>
  </a>
  <div class="inline-grid grid-cols-2 w-full">
    <a href="{{ route('car/show', ['car' => $car->id]) }}" class="block mt-3 font-semibold">{{ $car->car_name }}</a>
    <div class="items-start ml-auto "><a class="block mt-3 font-semibold text-primary flex items-center" href="{{ route('user/show', ['user' => $car->user->id]) }}"><i class="material-icons mr-2">camera_alt</i>{{ $car->user->name }}</a></div>
    <span class=" mt-1 font-medium text-grey col-span-2 flex items-center font-semibold"><i class="material-icons mr-1">location_on</i>{{ $car->location }}</span>
  </div>
</div>