@extends('layouts.app')

@section('title', "Add a snap |")

@section('content')
<section class="pt-12 sm:pt-inherit">
  <h1 class="heading mb-12">Add a snap</h1>
  <form class="grid gap-12 w-full sm:grid-cols-2" method="POST" action="{{ route('car/store') }}" enctype="multipart/form-data">
    @csrf

    @include('cars/_form')
    <div class="col-start-1">
      <button type="submit">{{ __('Add') }}</button>
    </div>
  </form>
</section>
@endsection