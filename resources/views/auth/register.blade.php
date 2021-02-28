@extends('layouts.app')

@section('title', "Register |")

@section('content')
<section class="h-full flex items-center pt-12 sm:pt-inherit">
  <div class="m-auto w-full sm:w-1/2 lg:w-1/3">
    <h1 class="heading">Register</h1>
    <form class="w-full" method="POST" action="{{ route('register') }}">
      @csrf

      <div class="flex flex-col mb-8 w-full">
        <label for="name" class="block font-semibold mb-4"> {{ __('Name') }}: </label>
        <input id="name" type="text" class="form-input p-2 w-full @error('name')  border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <p class="text-red-500 text-xs italic mt-4"> {{ $message }} </p>
        @enderror
      </div>
      <div class="flex flex-col mb-8">
        <label for="email" class="block font-semibold mb-4"> {{ __('E-Mail Address') }}: </label>
        <input id="email" type="email" class="form-input p-2 w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
        <p class="text-red-500 text-xs italic mt-4"> {{ $message }} </p>
        @enderror
      </div>
      <div class="flex flex-col mb-8">
        <label for="password" class="block font-semibold mb-4"> {{ __('Password') }}: </label>
        <input id="password" type="password" class="form-input p-2 w-full @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
        @error('password')
        <p class="text-red-500 text-xs italic mt-4"> {{ $message }} </p>
        @enderror
      </div>
      <div class="flex flex-col mb-8">
        <label for="password-confirm" class="block font-semibold mb-4"> {{ __('Confirm Password') }}: </label>
        <input id="password-confirm" type="password" class="form-input p-2 w-full" name="password_confirmation" required autocomplete="new-password">
      </div>
      <div class="flex lg:items-center flex-col lg:justify-between lg:flex-row">
        <button type="submit" class="p-4"> {{ __('Register') }} </button>
        <p class="color-grey text-center my-6 text-grey"> {{ __('Already have an account?') }} <a href="{{ route('login') }}"> {{ __('Login') }} </a> </p>
      </div>
    </form>
  </div>
</section>
@endsection