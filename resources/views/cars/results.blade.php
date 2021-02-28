@extends('layouts.app')

@section('title', request()->input('q') . ' |')

@section('content')
<section class="pt-1 sm:pt-0">
  <div class="flex flex-col items-center mb-14">
    <div class="my-12 sm:mb-12">
      <form action="{{ route('car/search') }}" method="GET" class="w-100">
        <div class="flex items-center input-container big-input">
          <i class="material-icons">search</i>
          <input type="text" name="q" id="big-search" class="form-input" value="{{ request()->input('q') }}" placeholder="Search" />
          <div class="vertical-divider mr-6"></div>
          <div class="custom-select-container" style="width: 255px;">
            <div class="custom-select">
              <div class="custom-select__trigger">
                <div class="w-full pl-4 capitalize" style="font-size: var(--fz-md); font-weight: 600;" id="searchSelect">{{ request()->input('option') ?? 'Cars' }}</div>
                <div class="arrow" style="font-size: 1.2em"><i class="material-icons">expand_more</i></div>
              </div>
              <div class="custom-options mt-4" id="search-options">
                <span class="custom-option search-option p-4" data-search-option="cars" style="font-size: var(--fz-md); font-weight: 600;">Cars</span>
                <span class="custom-option search-option p-4" data-search-option="locations" style="font-size: var(--fz-md); font-weight: 600;">Locations</span>
                <span class="custom-option search-option p-4" data-search-option="makes" style="font-size: var(--fz-md); font-weight: 600;">Makes</span>
                <span class="custom-option search-option p-4" data-search-option="models" style="font-size: var(--fz-md); font-weight: 600;">Models</span>
                <span class="custom-option search-option p-4" data-search-option="users" style="font-size: var(--fz-md); font-weight: 600;">Users</span>
              </div>
            </div>
          </div>
        </div>
        <input type="text" class="hidden" name="option" value="{{ request()->input('option') ?? 'cars' }}" id="searchOption">
        <input class="hidden" type="submit" value="Submit">
      </form>
    </div>
    @if(request()->input('q'))
    <div class="flex text-center flex-col">
      <h1 class="heading2 mb-2">{{ request()->input('q') }}</h1>
      <span class="text-grey">{{$cars->total()}} {{ request()->input('option') ?? 'cars' }} for '{{request()->input('q') }}'</span>
    </div>
    @endif
  </div>
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