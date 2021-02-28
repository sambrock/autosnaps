@extends('layouts.app')

@section('content')
<section class="pt-12 sm:pt-inherit">
  @if(isset($location))
  <div class="mb-12">
    <div class="flex text-center flex-col">
      <h1 class="heading2 mb-2">{{ $location }}</h1>
      <span class="text-grey">{{$cars->total()}} cars in {{ $location }}</span>
    </div>
  </div>
  @endif
  <div class="inline-grid grid-cols-1 w-full gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    @foreach($cars as $car)
    @include('components.card', ['car' => $car])
    @endforeach
  </div>
  <div class="pagination">
    {{ $cars->links('components.pagination') }}
  </div>
</section>
@endsection