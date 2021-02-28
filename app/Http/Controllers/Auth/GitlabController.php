<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GitlabController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('gitlab')->redirect();
    }

    public function callback()
    {
        $gitlab = Socialite::driver('gitlab')->user();

        $user = User::firstOrCreate([
            'email' => $gitlab->email,
        ], [
            'email' => $gitlab->email,
            'name' => $gitlab->name,
            'password' => Hash::make(Str::random(32)),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
