<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Car $car)
    {
        return $car->user->is($user);
    }

    public function delete(User $user, Car $car)
    {
        return $car->user->is($user);
    }
}
