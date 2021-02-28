<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $github = Socialite::driver('github')->user();

        $user = User::firstOrCreate([
            'email' => $github->email,
        ], [
            'email' => $github->email,
            'name' => $github->name,
            'password' => Hash::make(Str::random(32)),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
