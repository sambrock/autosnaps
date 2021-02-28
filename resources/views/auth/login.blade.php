@extends('layouts.app')

@section('title', "Login |")

@section('content')
<section class="flex items-center pt-12 sm:pt-inherit">
  <div class="m-auto w-full sm:w-1/2 lg:w-1/3">
    <h1 class="heading">Login</h1>
    <form class="w-full pb-8" method="POST" action="{{ route('login') }}">
      @csrf

      <div class="flex flex-col mb-8">
        <label for="email" class="block font-semibold mb-4"> {{ __('E-Mail Address') }}: </label>
        <input id="email" type="email" class="form-input w-full p-2 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <p class="text-red-500 text-xs italic mt-4"> {{ $message }} </p>
        @enderror
      </div>
      <div class="flex flex-col mb-16">
        <label for="password" class="block font-semibold mb-4"> {{ __('Password') }}: </label>
        <input id="password" type="password" class="form-input p-2 w-full @error('password') border-red-500 @enderror" name="password" required>
        @error('password')
        <p class="text-red-500 text-xs italic mt-4"> {{ $message }} </p>
        @enderror
      </div>
      <div class="flex lg:items-center flex-col lg:justify-between lg:flex-row">
        <button type="submit" class="p-4"> {{ __('Login') }} </button>
        <p class="block color-grey ml-auto text-grey"> {{ __("Don't have an account?") }} <a href="{{ route('register') }}"> {{ __('Register') }} </a></p>
      </div>
    </form>
    <hr class="divider">
    <div class="flex items-center justify-between pt-4">
      <a href="{{ route('github/redirect') }}" class="social-login-btn github-login p-4"><i class="fa fa-github"></i>Log in with GitHub </a>
    </div>
    <div class="flex items-center justify-between pt-8">
      <a href="{{ route('gitlab/redirect') }}" class="social-login-btn gitlab-login p-4"><i class="fa fa-gitlab"></i>Log in with GitLab </a>
    </div>
  </div>
</section>
@endsection