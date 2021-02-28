@extends('layouts.app')

@section('title', "{$user->name} |")

@section('content')
<section class="pt-10 sm:pt-12">
  <div class="sm:mb-12">
    <div class="flex text-center flex-col">
      <h1 class="heading2 mb-2">{{ $user->name }}</h1>
      <span class="text-grey">{{ $user->name }} has {{$cars->total()}} snaps.</span>
    </div>
  </div>
  <div class="inline-grid grid-cols-1 w-full gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    @foreach($cars as $car)
    @include('components.card', ['car' => $car])
    @endforeach
  </div>
  <div class="pagination">
    {{ $cars->links('components/pagination') }}
  </div>
</section>
@endsection