@extends('layouts.app')

@section('title', "Edit {$car->car_name} |")

@section('content')
<section class="pt-12 sm:pt-inherit">
  <h1 class="heading mb-12">Edit</h1>
  <form class="grid gap-12 w-full sm:grid-cols-2" method="POST" action="{{ route('car/update', $car->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('cars/_form')
    <div class="col-start-1">
      <button type="submit">{{ __('Edit') }}</button>
    </div>
  </form>
</section>
@endsection