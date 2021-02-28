<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users/show', ['user' => $user, 'cars' => Car::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(12)->onEachSide(1)]);
    }
}
