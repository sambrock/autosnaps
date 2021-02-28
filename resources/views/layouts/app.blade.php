<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') Auto Snaps</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#f23030">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">


  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Mapbox -->
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="root">
    <header class="p-4 flex justify-between fixed w-full z-10 items-center border-btm sm:py-4 sm:px-6" id="header">
      <a href="/" class="block my-auto flex" style="height: 40px;"><img src={{ asset('images/logo.svg') }} alt="logo" class="my-auto h-3 sm:h-5" /></a>
      <nav class="flex items-center">
        @guest
        <a class="hidden mr-6 sm:mr-12 sm:block" href="{{ route('login') }}">{{ __('Login') }}</a>
        <a class="hidden sm:block" href="{{ route('register') }}">{{ __('Register') }}</a>
        <div class="flex items-center ml-4 z-20 relative sm:hidden" id="menuBtn" onclick="toggleMenuDropdown()" style="font-size: 2em; line-height: 100%;">
          <i class="material-icons">menu</i>
        </div>
        @else
        <div class="hidden sm:block">
          <form action="{{ route('car/search') }}" method="GET" class="mr-6">
            <div class="flex items-center input-container">
              <i class="material-icons">search</i>
              <input type="text" name="q" id="search" class="form-input" value="{{ request()->input('q') }}" placeholder="Search" />
            </div>
          </form>
        </div>
        <a href="{{ route('car/new') }}" class="nav-btn mr-6 hidden sm:block">Add a snap</a>
        <div class="relative" onclick="toggleProfileDropdown()">
          <div class="relative rounded-full bg-dark-grey text-white cursor-pointer h-8 w-8 sm:h-12 sm:w-12">
            <span class="font-bold absolute top-1/2 left-1/2 select-none transform-center text-base sm:text-2xl">{{ Auth::user()->name[0]}}</span>
          </div>
          <div id="profileDropdown" class="hidden profile-dropdown absolute mt-4 right-0">
            <ul class="border-dark-grey list-none p-0 hidden sm:block" style="width: 160px;">
              <li class="p-3 border-btm"><a href="{{ route('user/show', ['user' => Auth::id()]) }}" class="flex items-center"><i class="material-icons mr-4 text-grey">camera_alt</i>My snaps</a></li>
              <li class="p-3">
                <a href="{{ route('logout') }}" class="flex items-center" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons mr-4 text-grey">exit_to_app</i>{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </div>
        </div>
        <div class="flex items-center ml-4 z-20 relative cursor-pointer sm:hidden" id="menuBtn" onclick="toggleMenuDropdown()" style="font-size: 2em; line-height: 100%;">
          <i class="material-icons">menu</i>
        </div>
        @endguest
      </nav>
    </header>
    <div class="hidden fixed z-10 w-full bg-black sm:hidden" id="menu" style="top: 72px; border-bottom: 1px solid var(--dark-grey)">
      <ul class="list-none p-0 m-4 bg-black">
        <li class="mb-6">
          <div class="w-full">
            <form action="{{ route('car/search') }}" method="GET">
              <div class="flex items-center input-container">
                <i class="material-icons">search</i>
                <input type="text" name="q" id="search" class="form-input" value="{{ request()->input('q') }}" placeholder="Search" />
              </div>
            </form>
          </div>
        </li>
        @guest
        <li class="mb-6"><a href="{{ route('login') }}" class="text-xl block flex items-center"><i class="material-icons mr-4 text-grey">person</i>{{ __('Login') }}</a></li>
        <li class="mb-6"><a href="{{ route('register') }}" class="text-xl block flex items-center"><i class="material-icons mr-4 text-grey">person_add</i>{{ __('Register') }}</a></li>
        @else
        <li class="mb-6"><a href="{{ route('user/show', ['user' => Auth::id()]) }}" class="text-xl block flex items-center"><i class="material-icons mr-4 text-grey">camera_alt</i>My snaps</a></li>
        <li class="mb-6"><a href="{{ route('car/new') }}" class="text-xl block flex items-center"><i class="material-icons mr-4 text-grey">add</i>Add a snap</a></li>
        <li class="mb-6">
          <a href="{{ route('logout') }}" class="text-xl block flex items-center" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
              class="material-icons mr-4 text-grey">exit_to_app</i>{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            {{ csrf_field() }}
          </form>
        </li>
        @endguest
      </ul>
    </div>
    <main id="content">
      @yield('content')
    </main>
  </div>
  <footer class="border-color-dark-grey pb-6 flex flex-col  text-center text-sm sm:text-base sm:pb-12">
    <a href="https://sambrock.com" class="text-dark-grey">Designed & built by Sam Brocklehurst</a>
  </footer>
</body>

<script>
  // const profileDropdown = document.getElementById('profileDropdown');
  const toggleProfileDropdown = () => document.getElementById('profileDropdown').classList.toggle('hidden');

  const toggleMenuDropdown = () => {
    document.getElementById('menu').classList.toggle('hidden');
    document.getElementById('header').classList.toggle('bg-black');
    };
</script>

</html>